<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Proyecto;
use App\Models\ProyectoParticipante;
use App\Models\Requerimientos;
use App\Models\requerimiento_Proyecto;
use Illuminate\Http\Request;

class RequerimientosController extends Controller
{

    public function index()
    {
        $requerimientos = Requerimientos::all();
        return view('proyectos.requerimientos', compact('requerimientos'));
    }
    public function store(Request $request)
    {
        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyectoParticipante = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();

        if ($proyectoParticipante != null) {
            $folioproyecto = $proyectoParticipante->Folio;

            // Obtener los requerimientos disponibles desde la base de datos
            $requerimientos = Requerimientos::all();

            // Obtener los datos del formulario
            $requerimientosSeleccionados = [];

            foreach ($requerimientos as $requerimiento) {
                if ($request->has("requerimiento{$requerimiento->Id_requerimientoEspecial}")) {
                    $requerimientosSeleccionados[] = [
                        'Folio' => $folioproyecto,
                        'Id_requerimientoEspecial' => $requerimiento->Id_requerimientoEspecial,
                        // Otros campos que puedas necesitar
                    ];
                }
            }

            // Guardar los requerimientos seleccionados
            foreach ($requerimientosSeleccionados as $requerimientoSeleccionado) {
                Requerimiento_Proyecto::create($requerimientoSeleccionado);
            }
        }

        return redirect()->route('proyectos.index')->with('success', 'Requerimientos guardados');
     }
}
