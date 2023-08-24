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

        //Boooleanos para habilitar las cards
        $ficha_tecnica_habilitada=True;
        $requerimientos_especiales_habilitada=False;
        $memoria_tecnica_habilitada=False;
        $modelo_negocios_habilitada=False;
       

        //Boleanos para revisare si ya se registro 
        $requerimientos_especiales_registrada=False;
        $memoria_tecnica_registrada=False;
        $modelo_negocios_registrada=False;
        $ficha_tecnica_registrada=False;


        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyectoParticipante = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
        
        $proyecto = null;
        
        if($proyectoParticipante!=null){
            $folioproyecto = $proyectoParticipante->Folio;

            $proyecto=Proyecto::where('Folio',$folioproyecto)->first();
            
           
            if($proyecto->Id_fichaTecnica!=null){
                //Ocultamo la ficha tecnica si ya esta registrada
                $ficha_tecnica_registrada=True;
                $ficha_tecnica_habilitada=false;
                //Habilitamos las demas cards
                $requerimientos_especiales_habilitada=True;
                $memoria_tecnica_habilitada=True;
                $modelo_negocios_habilitada=True;
    
            }
            
            if($proyecto->Id_memoriaTecnica!=null){
                    
               $memoria_tecnica_registrada=True;
                
            }
    
    
            if($proyecto->Modelo_negocio!=null){
                $modelo_negocios_registrada=True;
            }
        }
        
 
    
        return view('proyectos.proyectos',compact('ficha_tecnica_habilitada','memoria_tecnica_habilitada','modelo_negocios_habilitada','requerimientos_especiales_habilitada',
        'ficha_tecnica_registrada','requerimientos_especiales_registrada','memoria_tecnica_registrada','modelo_negocios_registrada','proyecto'));
    }

    public function obtenerParticipantes(Request $request)
    {
        $folioProyecto = $request->input('proyecto');

        // Realiza una consulta para obtener los participantes del proyecto
        $participantes = ProyectoParticipante::where('Folio', $folioProyecto)->get();
       
        $datosParticipantes = [];
        
        foreach ($participantes as $participante) {
            $datosParticipantes[] = [
                'Matricula' => $participante->Matricula,
                'Nombre' => $participante->estudiante->persona->Nombre_persona, 
                
            ];
        }
    
        
        return response()->json($datosParticipantes);
    }



   
}
