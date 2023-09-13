<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportarDatosController extends Controller
{

    public function index()
    {
        return view('regional.importarDatos');
    }
}