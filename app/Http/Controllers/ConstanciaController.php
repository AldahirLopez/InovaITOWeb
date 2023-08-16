<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;



class ConstanciaController extends Controller
{
    public function index()
    {
        return view('constancias.constancia');
    }

    public function show()
    {
        $pdf = PDF::loadView('constancias.pdf');
    
        // Otras operaciones y configuraciones si es necesario
        
        return $pdf->stream();
    }
}