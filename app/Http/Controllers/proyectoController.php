<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\ProyectoParticipante;
class proyectoController extends Controller
{

    public function index()


    {
        $ficha_tecnica_registrada=False;
        $requerimientos_especiales_registrada=False;

        $memoria_tecnica_registrada=False;
        $modelo_negocios_registrada=False;
        
        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyectoParticipante = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
        $folioproyecto = $proyectoParticipante->Folio;

        $proyecto=Proyecto::where('Folio',$folioproyecto)->first();
        
        if($proyecto->Id_fichaTecnica!=null){
            $ficha_tecnica_registrada=True;

        }

        if($proyecto->Id_memoriaTecnica!=null){
            $memoria_tecnica_registrada=True;

        }

        if($proyecto->Modelo_negocio!=null){
            $modelo_negocios_registrada=True;

        }
        
        



        return view('proyectos.proyectos',compact('ficha_tecnica_registrada','memoria_tecnica_registrada','modelo_negocios_registrada'));
    }





   
}
