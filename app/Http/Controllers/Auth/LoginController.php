<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\SocialLogin;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $userLogin = Socialite::driver('google')->stateless()->user();

        if($userSocial = SocialLogin::where('nick_email', $userLogin->email)->orWhere('nick_email', $userLogin->nickname)->first()){
            return $this->loginAndRedirect($userSocial->user);
        }else{
            //no existe usuario en BD
            $user = new User;
            $user->name = Str::of($userLogin->name)->explode(' ')[0];
            $user->email = $userLogin->email;
            $user->roles_id_rol = 2;
            $user->grados_id_grado = 1;
            $user->password = bcrypt(Str::random(10));
            $user->save();

            $userSocialNew = new SocialLogin;
            $userSocialNew->user_id = $user->id;
            $userSocialNew->provider = 'Google';
            $userSocialNew->nick_email = $userLogin->email;
            $userSocialNew->social_id = $userLogin->id;
            $userSocialNew->save();

            return $this->loginAndRedirect($user);
        }
    }
    private function loginAndRedirect($user){
        Auth::login($user);
        return redirect()->to('/');
    }
}
