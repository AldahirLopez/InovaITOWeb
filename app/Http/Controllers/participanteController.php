<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
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

    public function devolverCarrera(){

        $carreras = Carrera::all();

        // Obtener solo el nombre de cada centro
        $opciones = $carreras->map(function ($carrera) {
            return [
                'Nombre_carrera' => $carrera->Nombre_carrera,
                'Id_carrera' => $carrera->Id_carrera
            ];
        });

        // Devolver los resultados como respuesta JSON
        return response()->json($opciones);
    }

    public function store(Request $request)
    {

        $nombre = request()->input('nombre');
        $apellidoP = request()->input('apellidoP');
        $apellidoM = request()->input('apellidoM');
        $matricula = request()->input('matricula');
        $promedio = request()->input('promedio');
        $curp = request()->input('curp');
        $numIne = request()->input('numIne');
        $correo = request()->input('correo');
        $genero = request()->input('genero');
        $expectativa = request()->input('expectativa');
        $semestre = request()->input('semestre');
        $fechaNacimiento = request()->input('fechaNacimiento');
        $nivel = request()->input('nivel');
        $carrera = request()->input('carrera');



        // Crear una nueva instancia de la clase Persona y asignar los valores


        // Asignar otros valores necesarios

        // Guardar la persona en la base de datos


        // Guarda en el asesor en la base de datos



        // Redireccionar a la página de listar para mostrar la tabla actualizada
        return view('lider.lider');
    }


}
