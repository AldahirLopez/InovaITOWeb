<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Proyecto;
use App\Models\ProyectoParticipante;
use Illuminate\Http\Request;


class ModeloController extends Controller
{
    public function index()
    {
        return view('proyectos.modelo');
    }

    public function store(Request $request)
    {
        $liga = request()->input('archivo');

        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyectoParticipante = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();

        if ($proyectoParticipante != null) {
            $folioproyecto = $proyectoParticipante->Folio;

            $proyecto=Proyecto::where('Folio',$folioproyecto)->first();
            $proyecto->update(['Modelo_negocio' => $liga]);
            return redirect()->route('proyectos.index')->with('success', 'Memoria tecnica registrada ');
   
        }
        return redirect()->route('proyectos.index')->with('error', 'Memoria tecnica no registrada ');
   
    }
}
