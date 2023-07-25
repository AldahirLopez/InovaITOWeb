<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyectosPController extends Controller
{

    public function index()
    {
        return view('proyectos.proyectos_pendientes');
    }
}
