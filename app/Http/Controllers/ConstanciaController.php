<?php

namespace App\Http\Controllers;
use App\Models\Proyecto;
use App\Models\tecnologico;
use App\Models\estudiante;
use App\Models\usuario;
use App\Models\rol;
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
        $instituto = tecnologico::where('Clave_tecnologico',$request->input('instituto'))->first();
        $nombre_instituto=$instituto->Nombre_tecnologico;
        $estudiante=Estudiante::where('Matricula',$request->matricula)->first();
        $nombre_participante=$estudiante->persona->Nombre_persona;
        $apellido1= $estudiante->persona->Apellido1;
        $apellido2= $estudiante->persona->Apellido2;

        
        $usuario=Usuario::where('Id_persona',$estudiante->persona->Id_persona)->first();
       // $rol_participante=rol::where('Id_rol',$usuario->Id_rol)
      // $rol_participante=$usuario->rol->Nombre_rol;

    $datos = [
        'nombreProyecto' => $nombre_proyecto,
        'instituto' => $nombre_instituto,
        'coordinador' => $request->input('coordinador'),
        'cargo' => $request->input('cargo'),
        'director' => $request->input('director'),
        'fecha_inicio' => $request->input('fecha_inicio'),
        'fecha_fin' => $request->input('fecha_fin'),
        'categoria'=>$categoria_proyecto,
        'nombre_participante'=>$nombre_participante,
        'apellido1'=>$apellido1,
        'apellido2'=>$apellido2,
        //'rol_participante'=>$rol_participante,
    ];

    $pdf = Pdf::loadView('constancias.pdf', $datos);
    return $pdf->stream('constancia.pdf');


    }




}