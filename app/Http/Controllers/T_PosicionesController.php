<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class T_PosicionesController extends Controller
{

    public function index()
    {
        return view('evaluaciones.tabla_posiciones');
    }


}
