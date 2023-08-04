<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Espectativa;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\ProyectoParticipante;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class participanteController extends Controller
{

    public function index()
    {
        return view('participantes.participantes');
    }

    public function devolverEspectativa()
    {

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

    public function devolverCarrera()
    {

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




        //Generar ID Unico
        $datosUsuario = $nombre . $apellidoP . $apellidoM . $correo;
        $idGenerada = substr(sha1($datosUsuario), 0, 10);
        $idGenerada2 = strtolower($idGenerada);

        // Crear una nueva instancia de la clase Persona y asignar los valores
        $persona = new Persona();
        $persona->Id_persona = $idGenerada2;
        $persona->Nombre_persona = $nombre;
        $persona->Apellido1 = $apellidoP;
        $persona->Apellido2 = $apellidoM;
        $persona->Correo_electronico = $correo;

        // Creamos la nueva instacia de estudiante y asignamos valores
        $estudiante = new Estudiante();
        $estudiante->Matricula = $matricula;
        $estudiante->Fecha_nacimiento = $fechaNacimiento;
        $estudiante->Promedio = $promedio;
        $estudiante->Id_expectativa = $expectativa;
        $estudiante->Id_carrera = $carrera;
        $estudiante->Id_persona = $idGenerada2;
        $estudiante->Id_genero = $genero;
        $estudiante->Id_semestre = $semestre;
        $estudiante->Id_nivel = $nivel;

        // Guardar la persona en la base de datos
        $persona->save();

        $estudiante->save();

        // Validar el inicios de sesion y asiganarlo a un valor 
        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyecto = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
        $folioproyecto = $proyecto->Folio;

        // Crear la instacia de proyectoParticipante

        $proyectoParticipante = new ProyectoParticipante();

        // Buscar en la otra tabla utilizando el ID de la persona
        $proyectoParticipante->Folio = $folioproyecto;
        $proyectoParticipante->Matricula = $matricula;

        $proyectoParticipante->save();


        // Redireccionar a la página de listar para mostrar la tabla actualizada
        if (session()->has('usuario')) {
            $usuario = session('usuario');
            $idpersona = $usuario->Id_persona;
            $persona = Estudiante::where('Id_persona', $idpersona)->first();
            $matricula = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
            $folio = ProyectoParticipante::where('Folio', $matricula->Folio)->first();


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

                        $datosPersonas[] = [
                            'carrera' => $carrera,
                            'semestre' => $semestre,
                            'matricula' => $matricula,
                            'nombre' => $nombre,
                            'apellido1' => $apellido1,
                            'apellido2' => $apellido2,
                        ];
                    }
                }
            }


            // Obtener las matriculas de los participantes encontrados
            //$matriculas = $participantes->pluck('Matricula')->toArray();

            // Pasar la variable $participantes a la vista
            $mensaje="Participante registrado correctamente";
            return view('participantes.tabla_part', compact('datosPersonas','mensaje'));
        }
    }


}
