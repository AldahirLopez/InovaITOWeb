<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class curpController extends Controller
{
  public function generarCurp(Request $request){
    $nombre = $request->input('nombre');
    $primer_apellido = $request->input('primer_apellido');
    $segundo_apellido = $request->input('segundo_apellido');
    $sexo = $request->input('sexo');
    $fecha_nacimiento = $request->input('fecha_nacimiento');
    

    $curpGenerado=$this->CURP($nombre, $primer_apellido, $segundo_apellido, $sexo, $fecha_nacimiento);
    echo "<p>CURP Generado: $curpGenerado</p>";

  }



  


}
