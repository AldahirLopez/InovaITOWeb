<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Asesor;
use App\Models\Usuario;
use App\Models\proyectoAsesor;
use App\Models\Estudiante;
use App\Models\ProyectoParticipante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AsesorProyectoController extends Controller
{

    public function index()
    {

        
    }


    public function create(){
            return view('AsesorProyecto.agregar');
    }


    public function store(Request $request)
    {

        // Guarda en el asesor en la base de datos
        $asesor = new Asesor();
        $nombre = request()->input('nombres');
        $apellidop = request()->input('apellidoPaterno');
        $apellidom = request()->input('apellidoMaterno');
        $curp = request()->input('curp');
        $correo = request()->input('correo');
        $numIne = request()->input('numIne');
        $titulo = request()->input('titulo');
        $rfc = request()->input('rfc');
        $telefono = request()->input('telefono');
        $licenciatura = request()->input('licenciatura');
        $maestria = request()->input('maestria');
        $doctorado = request()->input('doctorado');
        $departamento = request()->input('CentroDepartamentos');

        //Datos faltantes para el curp
        $genero = request()->input('genero');
        $fechaNacimiento = request()->input('fechaNacimiento');


         
        if($genero=="GEN01"){
            $sexo='H';
        }else{
            $sexo='M';
        }

        //Aqui vamos a ver lo del curp
        $curpGenerado=$this->CURP($nombre, $apellidop, $apellidom, $sexo, $fechaNacimiento);
        
        if(substr($curp, 0, 10)!=substr($curpGenerado,0,10)){

            return redirect('/asesores/create')->with('error', 'CURP no valido con los datos ingresados');

        }

        if(Persona::where('Correo_electronico',$correo)->first()){
            return redirect('/asesores/create')->with('c_existente', 'Error:Correo ya registrado');

        }


        //Generar ID Unico
        $datosUsuario = $nombre . $apellidop . $apellidom . $correo;
        $idGenerada = substr(sha1($datosUsuario), 0, 10);
        $idGenerada2 = strtolower($idGenerada);

        //Metodo
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$*-+\|./?';
        $contrasena = '';
        for ($i = 0; $i < 8; $i++) {
            $index = random_int(0, strlen($caracteres) - 1);
            $contrasena .= $caracteres[$index];
        }

        $hash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Crear una nueva instancia de la clase Persona y asignar los valores
        $persona = new Persona();
        $persona->Id_persona = $idGenerada2;
        $persona->Nombre_persona = $nombre;
        $persona->Apellido1 = $apellidop;
        $persona->Apellido2 = $apellidom;
        $persona->Num_ine = $numIne;
        $persona->Curp = $curp;
        $persona->Telefono = $telefono;
        $persona->Correo_electronico = $correo;

        // Asignar otros valores necesarios
        $usuario = new Usuario();
        $usuario->Id_usuario = $idGenerada2;
        $usuario->Nombre_usuario = $correo;
        $usuario->Contrasena = $hash;
        $usuario->Id_persona = $idGenerada2;
        $usuario->Id_rol = "ROL03";

        // Guardar la persona en la base de datos
        $persona->save();

        //Asiganar valores a Asesor
        $letra = 'ASE';
        $numero = 1;
        $nomenclatura = $letra . str_pad($numero, 2, '0', STR_PAD_LEFT);

        //Comprueba que el id no este registrado en la base de datos
        // Verificar si la nomenclatura ya existe en la base de datos
        $opciones = Asesor::where('Id_asesor', $nomenclatura)->get();

        while ($opciones->count() > 0) {
            $numero++; // Incrementar el número
            $nomenclatura = $letra . str_pad($numero, 2, '0', STR_PAD_LEFT);
            $opciones = Asesor::where('Id_asesor', $nomenclatura)->get();
        }
        //Guardar la informacion en jurado 
        $asesor = new Asesor();
        $asesor->Id_asesor = $nomenclatura;
        $asesor->Id_persona = $idGenerada2;
        $asesor->Abreviatura_profesional = $titulo;
        $asesor->Licenciatura = $licenciatura;
        $asesor->Maestria = $maestria;
        $asesor->Doctorado = $doctorado;
        $asesor->RFC = $rfc;
        $asesor->Id_departamento = $departamento;
        
        $asesor->save();




        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyecto = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
        $folioproyecto = $proyecto->Folio;

     
        $proyectoAsesor=new proyectoAsesor();
        $proyectoAsesor->Id_asesor=$asesor->Id_asesor;
        $proyectoAsesor->Folio=$folioproyecto;
        $proyectoAsesor->save();


        //Enviamos el correo con la clave para que pueda hacer su login 
        $subject = "Datos de Login";
        $for = $correo;

        $data = [
            'contraena' => $contrasena,
            'correo' => $correo,
            // Agrega más variables aquí si es necesario
        ];

        Mail::send('email', $data, function ($msj) use ($subject, $for) {
            $msj->from("lopezaldahir21@gmail.com", "Datos Login");
            $msj->subject($subject);
            $msj->to($for);
        });

        //Se guarda 
        $usuario->save();

        // Redireccionar a la página de listar para mostrar la tabla actualizada
        return redirect()->route('participantes.tabla_part')->with('success', 'Asesor registrado correctamente');
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
      
         $apellido=strtoupper($apellido);
         $vocales = ['A', 'E', 'I', 'O', 'U'];
     
         for ($i = 1; $i < strlen($apellido); $i++) {
             if (in_array($apellido[$i], $vocales)) {
                 return $apellido[$i];
             }
         }
     
         return '';
     }


     
    public function destroy($id){
        
        $asesor = Asesor::where('Id_asesor',$id)->first();
     
    
        DB::table('asesorCargo')
        ->where('Id_asesor', $asesor->Id_asesor)
        ->delete();


        DB::table('asesor')
        ->where('Id_asesor', $asesor->Id_asesor)
        ->delete();

        DB::table('usuario')
        ->where('Id_persona', $asesor->persona->Id_persona)
        ->delete();

        DB::table('persona')
        ->where('Id_persona', $asesor->persona->Id_persona)
        ->delete();


        return redirect()->route('participantes.tabla_part')->with('delete', 'Asesor eliminado correctamente');
}

}