<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\validacionProyectoA;
use App\Models\validacionProyectoC;
use App\Models\coordinador;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
class proyectosCordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Listar los proyectos que ya aprobo el asesor
        $proyectosAprobados=validacionProyectoC::all();
        return view('proyectos.proyectos_aprobados_C',compact('proyectosAprobados'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $proyectosAprobados = $request->input('estado_proyecto');
     
        
        $estadoAcreditacion = 2;

        if($proyectosAprobados!=null){
            foreach ($proyectosAprobados as $proyectoAprobado) {
                $validacionProyectoC=new validacionProyectoC();
                DB::table('proyecto')
                ->where('Folio', $proyectoAprobado)
                ->update([
                    'Estado_acreditacion' =>$estadoAcreditacion
                    
                ]);

                DB::table('validacionProyectoA')
                ->where('Folio', $proyectoAprobado)
                ->update([
                    'Estado' =>$estadoAcreditacion
                    
                ]);
                //Aqui debe ir el Id del coordinado que este logueado

                $usuario = session('usuario');
                $idpersona = $usuario->Id_persona;
                $usuarioLogueado=Usuario::where('Id_persona',$idpersona)->first();

                $id_coordinador=coordinador::Where('Id_persona',$usuarioLogueado->Id_persona)->first();


                $validacionProyectoC->Id_coordinador=$id_coordinador->Id_coordinador;
                $validacionProyectoC->Folio=$proyectoAprobado;
                $validacionProyectoC->Fecha_validacion='2023-08-03';
                $validacionProyectoC->Observaciones="zi";
                $validacionProyectoC->estado=$estadoAcreditacion;
                $validacionProyectoC->save();
    
            }
    
        }

        return redirect()->route('proyectosC.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
