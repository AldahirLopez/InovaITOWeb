<?php

namespace App\Http\Controllers;

use App\Models\Espectativa;
use Illuminate\Http\Request;

class participanteController extends Controller
{

    public function index()
    {
        return view('participantes.participantes');
    }

    public function devolverEspectativa(){

        $espectativas = Espectativa::all();

        // Obtener solo el nombre de cada centro
        $opciones = $espectativas->map(function ($espectativa) {
            return [
                'Expectativa' => $espectativa->Expectativa,
                'Id_expectativa' => $espectativa->Id_expectativa
            ];
        });

        // Devolver los resultados como respuesta JSON
        return response()->json($opciones);
    }
}
