<?php

namespace App\Http\Controllers;

use App\actividades;
use App\grados;
use App\materias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActividadesController extends Controller
{
    public function index(){
        $materias = materias::all();
        $grados = grados::all();

        return view('catedraticos.actividades.index', compact('materias', 'grados'));
    }

    public function all(){
        if(Auth::user()->roles_id_rol === 1) {
            $actividades = actividades::where('id_docente', Auth::user()->id)
                ->join('materias', 'actividades.id_materia', '=', 'materias.id_materia')
                ->join('grados', 'actividades.grados_id_grado', '=', 'grados.id_grado')
                ->select('actividades.*', 'grados.descripcion as grado', 'materias.descripcion as materia')
                ->get();
        }else{
            $actividades = actividades::join('materias', 'actividades.id_materia', '=', 'materias.id_materia')
                ->join('grados', 'actividades.grados_id_grado', '=', 'grados.id_grado')
                ->join('users', 'actividades.id_docente', '=', 'users.id')
                ->select('actividades.*', 'grados.descripcion as grado', 'materias.descripcion as materia','users.name as catedratico')
                ->get();
        }
        return view('catedraticos.actividades.all', compact('actividades'));
    }

    public function store(Request $request){
        $file = $request->file('file');
        $archivopath = $this->uploadFile($file,'archivo');
        $actividad = new actividades;
        $actividad->descripcion = $request->descripcion;
        $actividad->url_actividad = $archivopath;
        $actividad->id_docente = Auth::user()->id;
        $actividad->id_materia = $request->materia;
        $actividad->grados_id_grado = $request->grado;
        $actividad->save();

        return redirect()->route('actividades.index');
    }

    function uploadFile($file, $dir)
    {
        $now = time();
        $tiempo = date('Y/m', $now);
        $fileName = '/' . $dir . '/' . $tiempo;
        return Storage::disk('local')->put($fileName, $file, 'public');
    }
}
