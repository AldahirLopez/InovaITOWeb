<?php

namespace App\Http\Controllers;
use App\Models\Proyecto;
use App\Models\tecnologico;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;


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
    

}

    public function generate2PDF(Request $request){
        
        $proyecto=Proyecto::find($request->proyecto);
        $nombre_proyecto=$proyecto->ficha->Nombre_proyecto;
        $categoria_proyecto=$proyecto->ficha->area->categoria->Nombre_categoria;
        $instituto = tecnologico::where('Clave_tecnologico',$request->input('instituto'))->first();;
        $nombre_instituto=$instituto->Nombre_tecnologico;
    $datos = [
        'nombreProyecto' => $nombre_proyecto,
        'instituto' => $nombre_instituto,
        'coordinador' => $request->input('coordinador'),
        'director' => $request->input('director'),
        'categoria'=>$categoria_proyecto,
    ];

    $pdf = Pdf::loadView('constancias.pdf', $datos);
    return $pdf->download('constancia.pdf');


    }




}