<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\validacionProyectoA;
use App\Models\validacionProyectoC;
use Illuminate\Support\Facades\DB;
class ProyectosAController extends Controller
{

    public function index()
    {
        $proyectosAsesoro=validacionProyectoA::all();
       $proyectosCordi=validacionProyectoC::all();
       $proyectosAprobados = $proyectosAsesoro->concat($proyectosCordi);
       return view('proyectos.proyectos_aprobados',compact('proyectosAprobados'));
      // return view('proyectos.pruebas');
    }

    public function store(Request $request){
        $proyectosAprobados = $request->input('estado_proyecto');

        $estadoAcreditacion = 1;

        foreach ($proyectosAprobados as $proyectoAprobado) {
            $validacionProyectoA=new validacionProyectoA();
            DB::table('proyecto')
            ->where('Folio', $proyectoAprobado)
            ->update([
                'Estado_acreditacion' =>$estadoAcreditacion
                
            ]);
            
            $validacionProyectoA->Id_asesor="ASE02";
            $validacionProyectoA->Folio=$proyectoAprobado;
            $validacionProyectoA->Fecha_validacion='2023-08-03';
            $validacionProyectoA->Observaciones="zi";
            $validacionProyectoA->estado=$estadoAcreditacion;
            $validacionProyectoA->save();

        }
        return redirect()->route('proyectos.index');


    }

}
