<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportarMenuController extends Controller
{

    public function index()
    {
        return view('regional.importarMenu');
    }
}