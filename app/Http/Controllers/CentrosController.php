<?php

namespace App\Http\Controllers;

use App\Models\Centros;
use App\Models\CentrosInvestigacion;
use App\Models\Departamentos;
use Illuminate\Http\Request;

class CentrosController extends Controller
{
    public function devolvercentros()
    {
        $centros = Centros::all();

        // Obtener solo el nombre de cada centro
        $institutos = $centros->map(function ($centro) {
            return [
                'Tipo_tec' => $centro->Tipo_tec,
                'Id_tipoTec' => $centro->Id_tipoTec
            ];
        });

        // Devolver los resultados como respuesta JSON
        return response()->json($institutos);
    }

    public function cargarTecnologicos($selectedValue)
    {
        // Obtener solo el nombre de cada centro
        $opciones = CentrosInvestigacion::where('Id_tipoTec', $selectedValue)->get(['Nombre_tecnologico','Clave_tecnologico']);

        if ($opciones->isEmpty()) {
            // No se encontraron resultados para el Id_tipoTec dado
            return response()->json(['error' => 'No se encontraron resultados para el Id_tipoTec dado'], 404);
        }

        // Devolver los resultados como respuesta JSON

        return response()->json(['opciones' => $opciones]);
    }

    public function cargarDepartamentos($selectedValue)
    {
        // Obtener solo el nombre de cada centro
        $opciones = Departamentos::where('Clave_tecnologico', $selectedValue)->get(['Nombre_departamento','Id_departamento']);

        if ($opciones->isEmpty()) {
            // No se encontraron resultados para el Id_tipoTec dado
            return response()->json(['error' => 'No se encontraron resultados para el Id_tipoTec dado'], 404);
        }

        // Devolver los resultados como respuesta JSON

        return response()->json(['opciones' => $opciones]);
    }
}
