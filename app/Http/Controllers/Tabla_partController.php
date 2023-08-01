<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tabla_partController extends Controller
{

    public function index()
    {
        return view('participantes.tabla_part');
    }
}
