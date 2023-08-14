<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\PDF;

class ConstanciaController extends Controller
{
    public function index()
    {
        return view('constancias.constancia');
    }

    public function generatePDF(Request $request)
{
    $data = [
        'content' => 'EL INSTITUTO TECNOLÓGICO DE MÉXICO A TRAVES DEL INSTITUTO TECNOLÓGICO DE OAXACA OTORGAN EL PRESENTE:'
    ];

    $pdf = PDF::loadView('constancias.pdf', $data);

    return $pdf->download('constancia.pdf');
}
}
