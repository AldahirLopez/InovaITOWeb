<?php

namespace App\Http\Controllers;

use App\Models\Memoria_t;
use Illuminate\Http\Request;

class Memoria_tController extends Controller
{

    public function index()
    {
        return view('proyectos.memoria_t');
    }

    public function store(Request $request)
    {
        // Accede a los valores de los checkbox mediante el método input() del objeto Request.
        $descripcion_problematica = request()->input('descripcion_problematica');
        $estado_arte = request()->input('estado_arte');
        $descripcion_innovacion = request()->input('descripcion_innovacion');
        $propuesta_valor = request()->input('propuesta_valor');
        $mercado_potencial = request()->input('mercado_potencial');

        $imagen_mercado_potencial = $request->file('imagen_mercado_potencial');
        $imagen_mercado_potencialblobData = file_get_contents($imagen_mercado_potencial->getRealPath());

        $viabilidad_tecnica = request()->input('viabilidad_tecnica');

        $imagen_viabilidad_tecnica = $request->file('imagen_mercado_potencial');
        $imagen_viabilidad_tecnicablobData = file_get_contents($imagen_viabilidad_tecnica->getRealPath());


        $viabilidad_financiera = request()->input('viabilidad_financiera');

        $imagen_viabilidad_financiera = $request->file('imagen_mercado_potencial');
        $imagen_viabilidad_financierablobData = file_get_contents($imagen_viabilidad_financiera->getRealPath());


        $estrategia_propiedad_intelectual = request()->input('estrategia_propiedad_intelectual');


        $imagen_propiedad_intelectual = $request->file('imagen_mercado_potencial');
        $imagen_propiedad_intelectualblobData = file_get_contents($imagen_propiedad_intelectual->getRealPath());

        $interpretacion_resultados = request()->input('interpretacion_resultados');
        $fuentes_consultadas = request()->input('fuentes_consultadas');

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


         return redirect()->route('proyectos.index')->with('success', 'Memoria tecnica registrada ');
    }

}
