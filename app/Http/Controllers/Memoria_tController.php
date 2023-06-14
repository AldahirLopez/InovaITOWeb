<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Memoria_tController extends Controller
{

    public function index()
    {
        return view('proyectos.memoria_t');
    }
}
