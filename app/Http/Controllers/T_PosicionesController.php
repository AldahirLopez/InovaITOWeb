<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Proyecto;

class T_PosicionesController extends Controller
{

    public function index()
    {



        $proyectos = Proyecto::selectRaw('*, @rownum := @rownum + 1 AS posicion')
            ->whereNotNull('Calificacion_global')
            ->orderBy(DB::raw('CAST(Calificacion_global AS UNSIGNED)'), 'desc')
            ->crossJoin(DB::raw('(SELECT @rownum := 0) AS r'))
            ->get();
        $categorias = Categorias::all();




        return view('evaluaciones.tabla_posiciones', compact('proyectos', 'categorias'));
    }

    public function filtrar(Request $request)
    {
        $categoriaId = $request->input('categoria');

        $proyectos = Proyecto::selectRaw('*, @rownum := @rownum + 1 AS posicion')
            ->whereNotNull('Calificacion_global')
            ->when($categoriaId !== 'all', function ($query) use ($categoriaId) {
                $query->whereHas('ficha.area.categoria', function ($q) use ($categoriaId) {
                    $q->where('Id_categoria', $categoriaId);
                });
            })
            ->orderBy(DB::raw('CAST(Calificacion_global AS UNSIGNED)'), 'desc')
            ->crossJoin(DB::raw('(SELECT @rownum := 0) AS r'))
            ->get();

        $categorias = Categorias::all();

        return view('evaluaciones.tabla_posiciones', compact('proyectos', 'categorias'));
    }
}
