<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Memoria_t;
use App\Models\Proyecto;
use App\Models\ProyectoParticipante;
use Illuminate\Http\Request;

class Memoria_tController extends Controller
{

    public function index()
    {
        return view('proyectos.memoria_t');
    }

    public function store(Request $request)
    {
        // Accede a los valores del formulario
        $descripcion_problematica = $request->input('descripcion_problematica');
        $estado_arte = $request->input('estado_arte');
        $descripcion_innovacion = $request->input('descripcion_innovacion');
        $propuesta_valor = $request->input('propuesta_valor');
        $mercado_potencial = $request->input('mercado_potencial');

        $imagen_mercado_potencial = $request->file('imagen_mercado_potencial');
        $imagen_mercado_potencial_blobData = $imagen_mercado_potencial ? file_get_contents($imagen_mercado_potencial->getRealPath()) : null;

        $viabilidad_tecnica = $request->input('viabilidad_tecnica');

        $imagen_viabilidad_tecnica = $request->file('imagen_viabilidad_tecnica');
        $imagen_viabilidad_tecnica_blobData = $imagen_viabilidad_tecnica ? file_get_contents($imagen_viabilidad_tecnica->getRealPath()) : null;

        $viabilidad_financiera = $request->input('viabilidad_financiera');

        $imagen_viabilidad_financiera = $request->file('imagen_viabilidad_financiera');
        $imagen_viabilidad_financiera_blobData = $imagen_viabilidad_financiera ? file_get_contents($imagen_viabilidad_financiera->getRealPath()) : null;

        $estrategia_propiedad_intelectual = $request->input('estrategia_propiedad_intelectual');

        $imagen_propiedad_intelectual = $request->file('imagen_propiedad_intelectual');
        $imagen_propiedad_intelectual_blobData = $imagen_propiedad_intelectual ? file_get_contents($imagen_propiedad_intelectual->getRealPath()) : null;

        $interpretacion_resultados = $request->input('interpretacion_resultados');
        $fuentes_consultadas = $request->input('fuentes_consultadas');

        //Asiganar valores a Asesor
        $letra = 'MEMO';
        $numero = 1;
        $nomenclatura = $letra . str_pad($numero, 2, '0', STR_PAD_LEFT);

        //Comprueba que el id no este registrado en la base de datos
        // Verificar si la nomenclatura ya existe en la base de datos
        $opciones = Memoria_t::where('Id_memoriaTecnica', $nomenclatura)->get();

        while ($opciones->count() > 0) {
            $numero++; // Incrementar el número
            $nomenclatura = $letra . str_pad($numero, 2, '0', STR_PAD_LEFT);
            $opciones = Memoria_t::where('Id_memoriaTecnica', $nomenclatura)->get();
        }

        $memoria = new Memoria_t();
        $memoria->Id_memoriaTecnica = $nomenclatura;
        $memoria->Descripcion_problematica = $descripcion_problematica;
        $memoria->Estado_arte = $estado_arte;
        $memoria->Descripcion_innovacion = $descripcion_innovacion;
        $memoria->Propuesta_valor = $propuesta_valor;
        $memoria->Mercado_potencial = $mercado_potencial;
        $memoria->Imagen_mercadoPotencial = $imagen_mercado_potencial_blobData;
        $memoria->Viabilidad_tecnica = $viabilidad_tecnica;
        $memoria->Imagen_viabilidadTecnica = $imagen_viabilidad_tecnica_blobData;
        $memoria->Viabilidad_financiera = $viabilidad_financiera;
        $memoria->Imagen_viabilidadFinanciera = $imagen_viabilidad_financiera_blobData;
        $memoria->Estrategia_propiedadIntelectual = $estrategia_propiedad_intelectual;
        $memoria->Imagen_propiedadIntelectual = $imagen_propiedad_intelectual_blobData;
        $memoria->Interpretacion_resultados = $interpretacion_resultados;
        $memoria->Fuentes_consultadas = $fuentes_consultadas;

        $memoria->save();
        
        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyectoParticipante = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
        
        if($proyectoParticipante!=null){
            $folioproyecto = $proyectoParticipante->Folio;

            $proyecto=Proyecto::where('Folio',$folioproyecto)->first();
            $proyecto->update(['Id_memoriaTecnica' => $nomenclatura]);
        }




        return redirect()->route('proyectos.index')->with('success', 'Memoria tecnica registrada ');
    }
}
