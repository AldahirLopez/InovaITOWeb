<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\validacionProyectoA;
use App\Models\validacionProyectoC;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Http\Controllers\AsesorController;
use App\Models\Asesor;
class ProyectosAController extends Controller
{

    public function index()
    {
       
       $proyectosAprobados=validacionProyectoA::all();
       return view('proyectos.proyectos_aprobados',compact('proyectosAprobados'));
      // return view('proyectos.pruebas');
    }

    public function store(Request $request){
        $proyectosAprobados = $request->input('estado_proyecto');
        $proyectosEditar=$request->input('estado_proyecto_editar');
        
        $estadoAcreditacion = 1;

        if($proyectosAprobados!=null){
            foreach ($proyectosAprobados as $proyectoAprobado) {
                $validacionProyectoA=new validacionProyectoA();
                DB::table('proyecto')
                ->where('Folio', $proyectoAprobado)
                ->update([
                    'Estado_acreditacion' =>$estadoAcreditacion
                    
                ]);

                $usuario = session('usuario');
                $idpersona = $usuario->Id_persona;
                $usuarioLogueado=Usuario::where('Id_persona',$idpersona)->first();
                $asesor=Asesor::Where('Id_persona',$idpersona)->first();

                //Aqui debe ir el Id del asesor que este logueado
                $validacionProyectoA->Id_asesor=$asesor->Id_asesor;
                $validacionProyectoA->Folio=$proyectoAprobado;
                $validacionProyectoA->Fecha_validacion='2023-08-03';
                $validacionProyectoA->Observaciones="zi";
                $validacionProyectoA->estado=$estadoAcreditacion;
                $validacionProyectoA->save();
    
            }
    
        }

        if($proyectosEditar!=null){
      
            foreach ($proyectosEditar as $proyectoEditar) {
                $validacionProyectoA=new validacionProyectoA();
                DB::table('proyecto')
                ->where('Folio', $proyectoEditar)
                ->update([
                    'Id_memoriaTecnica' =>null,
                    'Modelo_negocio' =>null
                    
                ]);
                    
            }

        }     

        return redirect()->route('proyectosP.index');


    }

}
