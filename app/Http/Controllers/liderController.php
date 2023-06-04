<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class liderController extends Controller
{

    public function index()
    {
        return view('lider.lider');
    }
}
