<?php

namespace App\Http\Controllers;
use App\Models\Proyecto;
use App\Models\tecnologico;
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
        // Obtener todos los proyectos disponibles desde la base de datos
        $proyectos = Proyecto::all();
        $institutos = tecnologico::all(); // Obtén los institutos
        return view('constancias.constancia', compact('proyectos', 'institutos'));
    }

    public function show(Request $request)
{
    $nombreProyecto = $request->input('proyecto');
    $instituto = $request->input('instituto');
    $coordinador = $request->input('coordinador');
    $director = $request->input('director');

    $pdfContent = view('constancias.pdf', [
        'nombreProyecto' => $nombreProyecto,
        'instituto' => $instituto,
        'coordinador' => $coordinador,
        'director' => $director,
    ])->render();

    $pdf = PDF::loadHtml($pdfContent);
    return $pdf->stream('constancia.pdf');
}
}