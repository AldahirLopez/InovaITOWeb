<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\persona;
use App\Models\Usuario;
use App\Models\coordinador;
use App\Models\tecnologico;
use App\Models\validacionProyectoC;
use Illuminate\Support\Facades\DB;
class coordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordinadores=coordinador::all();
       return view('coordinador.index',compact('coordinadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tecnologicos=tecnologico::all();
        return view('coordinador.agregar',compact('tecnologicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nombre = request()->input('nombre');
        $apellidop = request()->input('apellidoP');
        $apellidom = request()->input('apellidoM');
        $telefono = request()->input('telefono');
        $correo = request()->input('correo');
        $identificacion = request()->input('identificacion');
        $curp = request()->input('curp');
        $genero = request()->input('genero');
        $fechaNacimiento = request()->input('fechaNacimiento');
        //Parte del curp
        
        if($genero=="GEN01"){
            $sexo='H';
        }else{
            $sexo='M';
        }

        //Aqui vamos a ver lo del curp
        $curpGenerado=$this->CURP($nombre, $apellidop, $apellidom, $sexo, $fechaNacimiento);
        
        if(substr($curp, 0, 10)!=substr($curpGenerado,0,10)){

            return redirect('/coordinador/create')->with('error', 'CURP no valido con los datos ingresados');

        }

        if(Persona::where('Correo_electronico',$correo)->first()){
            return redirect('/coordinador/create')->with('c_existente', 'Error:Correo ya registrado');

        }

       $nombre= strtolower($nombre);
       $apellidop=strtolower($apellidop);
       $apellidom= strtolower($apellidom);
       $correo=strtolower($correo);


        //datos del coordinador
        $id_coordinador = request()->input('id_coordinador');
        $clave_tecnologico=request()->input('Clave_tecnologico');

        $datosUsuario = $nombre . $apellidop . $apellidom . $correo;
        $idGenerada = substr(sha1($datosUsuario), 0, 10);
        $idGenerada2 = strtolower($idGenerada);


        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$*-+\|./?';
        $contrasena = '';
        for ($i = 0; $i < 8; $i++) {
            $index = random_int(0, strlen($caracteres) - 1);
            $contrasena .= $caracteres[$index];
        }

        $hash = password_hash($contrasena, PASSWORD_BCRYPT);




     
        if(coordinador::where('Id_persona',$idGenerada2)->exists()){
            return redirect('/coordinador/create')->with('duplicado', 'Error:Coordinador ya existente');
        }



        $persona = new Persona();
        $persona->Id_persona = $idGenerada2;
        $persona->Nombre_persona = $nombre;
        $persona->Apellido1 = $apellidop;
        $persona->Apellido2 = $apellidom;
        $persona->Correo_electronico = $correo;
        $persona->Telefono = $telefono;
        $persona->Num_ine = $identificacion;
        $persona->Curp = $curp;
        $persona->save();


        // Asignar otros valores necesarios
        $usuario = new Usuario();
        $usuario->Id_usuario = $idGenerada2;
        $usuario->Nombre_usuario = $correo;
        $usuario->Contrasena = $hash;
        $usuario->Id_persona = $idGenerada2;
        $usuario->Id_rol="ROL01";
        $usuario->save();

        //Agregamos el coordinador

        $Coordinador=new coordinador();
        $Coordinador->Id_coordinador=$id_coordinador;
        $Coordinador->Id_persona=$idGenerada2;
        $Coordinador->Clave_tecnologico=$clave_tecnologico;
        $Coordinador->save();



        return redirect()->route('coordinador.index')->with('success', 'Coordinador registrado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   

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
        
    $coordinador = coordinador::where('Id_coordinador',$id)->first();
 
    validacionProyectoC::where('Id_coordinador', $coordinador->Id_coordinador)->delete();
    
    

    DB::table('coordinadorActividad')
    ->where('Id_coordinador', $coordinador->Id_coordinador)
    ->delete();


    DB::table('coordinador')
    ->where('Id_coordinador', $coordinador->Id_coordinador)
    ->delete();


    DB::table('usuario')
    ->where('Id_persona', $coordinador->persona->Id_persona)
    ->delete();

    DB::table('persona')
    ->where('Id_persona', $coordinador->persona->Id_persona)
    ->delete();


    return redirect()->route('coordinador.index')->with('delete', 'Coordinador eliminado correctamente');
}
}
