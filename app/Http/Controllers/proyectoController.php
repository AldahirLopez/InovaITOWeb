<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class proyectoController extends Controller
{

    public function index()
    {
        return view('proyectos.proyectos');
    }

   
}
