<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class participanteController extends Controller
{

    public function index()
    {
        return view('participantes.participantes');
    }
}
