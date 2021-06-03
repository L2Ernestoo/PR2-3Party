<?php

namespace App\Http\Controllers;

use App\grados;
use App\materias;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function index(){
        $materias = materias::all();
        $grados = grados::all();

        return view('catedraticos.actividades.index', compact('materias', 'grados'));
    }

    public function store(Request $request){

    }
}
