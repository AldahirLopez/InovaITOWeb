<?php

namespace App\Http\Controllers;
use App\Models\Proyecto;
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
    
        return view('constancias.constancia', ['proyectos' => $proyectos]);
    }

    public function show(Request $request)
    {
        // Obtener el nombre del proyecto seleccionado desde el formulario
        $nombreProyecto = $request->input('proyecto');

        // Generar el contenido del PDF utilizando el nombre del proyecto
        $pdfContent = view('constancias.pdf', ['nombreProyecto' => $nombreProyecto])->render();

        // Generar el PDF utilizando la librería PDF
        $pdf = PDF::loadHtml($pdfContent);

        // Descargar el PDF
        return $pdf->stream('constancia.pdf');
    }
}