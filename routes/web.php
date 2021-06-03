<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');

Route::get('login/social/google','Auth\LoginController@redirectToProvider')->name('login.google');
Route::get('login/social/callback/google', 'Auth\LoginController@handleProviderCallback');


Route::get('catedratico/registro-contenido', 'ActividadesController@index')->name('actividades.index');
Route::post('store/actividad', 'ActividadesController@store')->name('actividades.store');

