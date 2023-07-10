<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequerimientosController extends Controller
{

    public function index()
    {
        return view('proyectos.proyectos_aprobados');
    }
}
