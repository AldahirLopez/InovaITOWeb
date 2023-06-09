<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class proyectoController extends Controller
{

    public function index()
    {
        return view('proyectos.requerimientos');
    }
}
