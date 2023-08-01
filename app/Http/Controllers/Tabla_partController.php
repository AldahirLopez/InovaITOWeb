<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\ProyectoParticipante;
use Illuminate\Http\Request;

class Tabla_partController extends Controller
{

    public function index()
    {

        if (session()->has('usuario')) {
            $usuario = session('usuario');
            $idpersona = $usuario->Id_persona;
            $persona = Estudiante::where('Id_persona', $idpersona)->first();
            $proyecto = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
            // Pasar la variable $proyecto a la vista
            return view('participantes.tabla_part', compact('proyecto'));
        }
    }
}
