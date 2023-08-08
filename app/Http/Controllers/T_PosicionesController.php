<?php

namespace App\Http\Controllers;
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




        return view('evaluaciones.tabla_posiciones',compact('proyectos'));
    }

    public function listarproyectos(){
        
    }

}
