<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Espectativa;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\ProyectoParticipante;
use App\Models\Semestre;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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

     

        if($genero=="GEN01"){
            $sexo='H';
        }else{
            $sexo='M';
        }

        //Aqui vamos a ver lo del curp
        $curpGenerado=$this->CURP($nombre, $apellidoP, $apellidoM, $sexo, $fechaNacimiento);
        
        if(substr($curp, 0, 10)!=substr($curpGenerado,0,10)){

            return redirect('/participantes')->with('error', $curpGenerado);
        }


        if(Persona::where('Correo_electronico',$correo)->first()){
            return redirect('/participantes')->with('c_existente', 'Error:Correo ya registrado');

        }

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

                        $usuario=Usuario::where('Id_persona',$id_persona)->first();
                        $datosPersonas[] = [
                            'carrera' => $carrera,
                            'semestre' => $semestre,
                            'matricula' => $matricula,
                            'nombre' => $nombre,
                            'apellido1' => $apellido1,
                            'apellido2' => $apellido2,
                            'usuario'=>$usuario,
                           
                        ];
                    }
                }
            }


            // Obtener las matriculas de los participantes encontrados
            //$matriculas = $participantes->pluck('Matricula')->toArray();

            // Pasar la variable $participantes a la vista

            return redirect()->route('tabla_part.index')->with('success', 'Participante registrado correctamente');

        }
    }

    public function CURP($nombre, $primerApellido, $segundoApellido, $sexo, $fechaNacimiento) {
            // Convertir la fecha de nacimiento al formato YYMMDD
            $fechaNacimientoFormatoCURP = date('ymd', strtotime($fechaNacimiento));

            // Asegurar que el mes y el día de nacimiento tengan dos dígitos
            $mesNacimiento = substr($fechaNacimientoFormatoCURP, 2, 2);
            $diaNacimiento = substr($fechaNacimientoFormatoCURP, 4, 2);
    
            // Obtener la primera vocal interna del primer apellido
            $vocalInterna = $this->obtenerPrimeraVocalInterna($primerApellido);
    
            // Generar el CURP
            $curp = strtoupper(
                substr($primerApellido, 0, 1) .      // Letra inicial del primer apellido
                $vocalInterna .                       // Primera vocal interna del primer apellido
                substr($segundoApellido, 0, 1) .     // Letra inicial del segundo apellido
                substr($nombre, 0, 1) .              // Primera letra del nombre
                $fechaNacimientoFormatoCURP .        // Año, mes y día de nacimiento
                $sexo                                // Sexo
            );
    
            return $curp;
   }
   
   private function obtenerPrimeraVocalInterna($apellido)
   {
       $vocales = ['A', 'E', 'I', 'O', 'U'];
       $apellido=strtoupper($apellido);
       for ($i = 1; $i < strlen($apellido); $i++) {
           if (in_array($apellido[$i], $vocales)) {
               return $apellido[$i];
           }
       }
   
       return ''; // Si no se encuentra ninguna vocal interna
   }



    public function edit(string $matricula)
    {
        $personaparticipante = Estudiante::where('Matricula',$matricula)->first();
        return view('participantes.editar',compact('personaparticipante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $personaparticipante = Estudiante::where('Matricula',$id)->first();

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



        if($genero=="GEN01"){
            $sexo='H';
        }else{
            $sexo='M';
        }

        //Aqui vamos a ver lo del curp
        $curpGenerado=$this->CURP($nombre, $apellidoP, $apellidoM, $sexo, $fechaNacimiento);
        
        if(substr($curp, 0, 10)!=substr($curpGenerado,0,10)){

            return redirect('/participantes')->with('error', 'Error:El curp no concuerda con los datos');
        }
        if(Persona::where('Correo_electronico',$correo)->first()){
            return redirect('/participantes')->with('c_existente', 'Error:Correo ya registrado');

        }



        //Actualizar datos del  estudiante

        DB::table('estudiante')
        ->where('matricula', $personaparticipante->Matricula)
        ->update([
            'Fecha_nacimiento' => $fechaNacimiento,
            'Promedio' => $promedio,
            'Id_expectativa'=>$expectativa,
            'Id_carrera'=>$carrera,
            'Id_genero'=>$genero,
            'Id_semestre'=>$semestre,
            'Id_nivel'=>$nivel,

        ]);
            //Actualizar datos de la persona
        DB::table('persona')
        ->where('Id_persona', $personaparticipante->persona->Id_persona)
        ->update([
            'Nombre_persona'=>$nombre,
            'Apellido1' => $apellidoP,
            'Apellido2' => $apellidoM,
            'Correo_electronico'=>$correo,
            'Num_ine'=>$numIne,
            'Curp'=>$curp,

        ]);

    
        
        return redirect()->route('tabla_part.index')->with('update', 'Participante actualizado correctamente');
    }
    public function destroy(string $id)
    {
        $personaparticipante = Estudiante::where('Matricula',$id)->first();
        $user=Usuario::where('Id_usuario',$personaparticipante->persona->Id_persona)->first();
        
    
        DB::table('proyectoParticipante')
        ->where('Matricula', $personaparticipante->Matricula)
        ->delete();

        DB::table('estudiante')
        ->where('Matricula', $personaparticipante->Matricula)
        ->delete();

        DB::table('persona')
        ->where('Id_persona', $personaparticipante->persona->Id_persona)
        ->delete();


        return redirect()->route('tabla_part.index')->with('delete', 'Participante eliminado correctamente');
    }

}
