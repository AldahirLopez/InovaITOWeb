<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Categorias;
use App\Models\Naturaleza;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function devolvercategorias()
    {
        $categorias = Categorias::all();

        // Obtener solo el nombre de cada centro
        $categorias1 = $categorias->map(function ($categoria) {
            return [
                'Id_categoria' => $categoria->Id_categoria,
                'Nombre_categoria' => $categoria->Nombre_categoria
            ];
        });

        // Devolver los resultados como respuesta JSON
        return response()->json($categorias1);
    }

    public function cargarAreas($selectedValue)
    {
        // Obtener solo el nombre de cada centro
        $opciones = Area::where('Id_categoria', $selectedValue)->get(['Nombre_area','Id_area']);

        if ($opciones->isEmpty()) {
            // No se encontraron resultados para el Id_tipoTec dado
            return response()->json(['error' => 'No se encontraron resultados para el Id_tipoTec dado'], 404);
        }

        // Devolver los resultados como respuesta JSON

        return response()->json(['opciones' => $opciones]);
    }

    public function cargarNaturaleza()
    {
        // Obtener solo el nombre de cada centro
        $opciones = Naturaleza::all();
        // Obtener solo el nombre de cada centro
        return response()->json(['opciones' => $opciones]);
    }

}
