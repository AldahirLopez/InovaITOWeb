<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\proyectoAsesor;
use App\Models\Usuario;
use App\Models\ProyectoParticipante;
use App\Models\Semestre;
use Illuminate\Http\Request;

class Tabla_partController extends Controller
{

    public function index()
    {

        if (session()->has('usuario')) {
            $usuario = session('usuario');
            $idpersona = $usuario->Id_persona;
            $persona = Estudiante::where('Id_persona', $idpersona)->first();
            $matricula = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
            $folio = ProyectoParticipante::where('Folio', $matricula->Folio)->first();

            $asesor = Asesor::all();
            $asesoresProyectos = ProyectoAsesor::where('Folio', $matricula->Folio)->get();

            $datosAsesores = [];

            foreach ($asesoresProyectos as $asesoresProyecto) {
                $asesoresEncontrados = Asesor::where('Id_asesor', $asesoresProyecto->Id_asesor)->get();

                if ($asesoresEncontrados->isNotEmpty()) {
                    foreach ($asesoresEncontrados as $asesorEncontrado) {
                        $datosAsesores[] = $asesorEncontrado;
                    }
                }
            }
            //Buscar todos los registros de ProyectoParticipante que coincidan con la Folio 
            $folio = $matricula->Folio;
            $registros = ProyectoParticipante::where('Folio', $folio)->get();

            //$id_personas = []; // Un array para almacenar las id_persona

            foreach ($registros as $registro) {
                $personaparticipante = Estudiante::where('Matricula', $registro->Matricula)->first();

                // Verifica que se encontró el estudiante con esa matrícula antes de almacenar la id_persona
                if ($personaparticipante) {
                    $id_persona = $personaparticipante->Id_persona;
                    $persona = Persona::where('Id_persona', $id_persona)->first();

                    // Verifica si se encontró una persona con el ID dado
                    if ($persona) {
                        // Accede a los datos de la persona encontrada

                        $semestre = Semestre::where('Id_semestre', $personaparticipante->Id_semestre)->first();
                        $carrera = Carrera::where('Id_carrera', $personaparticipante->Id_carrera)->first();
                        $matricula = $registro->Matricula;
                        $nombre = $persona->Nombre_persona;
                        $apellido1 = $persona->Apellido1;
                        $apellido2 = $persona->Apellido2;

                        $carreraNombre = $carrera ? $carrera->Nombre_carrera : 'No tiene carrera asignada';
                        $semestreNumero = $semestre ? $semestre->Numero_semestre : 'No tiene semestre asignado';
                        $usuario = Usuario::where('Id_persona', $id_persona)->first();


                        $datosPersonas[] = [
                            'carrera' => $carreraNombre,
                            'semestre' => $semestreNumero,
                            'matricula' => $matricula,
                            'nombre' => $nombre,
                            'apellido1' => $apellido1,
                            'apellido2' => $apellido2,
                            'usuario' => $usuario,
                        ];
                    }
                }
            }


            // Obtener las matriculas de los participantes encontrados
            //$matriculas = $participantes->pluck('Matricula')->toArray();

            // Pasar la variable $participantes a la vista
            $mensaje = "";
            $asesores = Asesor::all();
            return view('participantes.tabla_part', compact('datosPersonas', 'mensaje', 'datosAsesores'));
        }
    }
}
