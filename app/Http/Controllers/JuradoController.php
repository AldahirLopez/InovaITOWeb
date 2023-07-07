<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuradoController extends Controller
{

    public function index()
    {
        return view('jurado.jurado');
    }
}
