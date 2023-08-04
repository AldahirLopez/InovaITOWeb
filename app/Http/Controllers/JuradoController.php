<?php

namespace App\Http\Controllers;

use App\Models\Jurado;
use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class JuradoController extends Controller
{

    public function index()
    {
        return view('jurado.jurado');
    }
    public function store(Request $request)
    {
        $nombres = request()->input('nombres');
        $apellidop = request()->input('apellidoPaterno');
        $apellidom = request()->input('apellidoMaterno');
        $curp = request()->input('curp');
        $correo = request()->input('correo');
        $numIne = request()->input('numIne');
        $rfc = request()->input('rfc');
        $telefono = request()->input('telefono');

        //Generar ID Unico
        $datosUsuario = $nombres . $apellidop . $apellidom . $correo;
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
        $persona->Nombre_persona = $nombres;
        $persona->Apellido1 = $apellidop;
        $persona->Apellido2 = $apellidom;
        $persona->Telefono = $telefono;
        $persona->Correo_electronico = $correo;
        $persona->Num_ine = $numIne;
        $persona->Curp = $curp;

        // Asignar otros valores necesarios
        $usuario = new Usuario();
        $usuario->Id_usuario = $idGenerada2;
        $usuario->Nombre_usuario = $correo;
        $usuario->Contrasena = $hash;
        $usuario->Id_persona = $idGenerada2;
        $usuario->Id_rol = "ROL04";

        $persona->save();

        //Asiganar valores a jurado
        $letra = 'JUR';
        $numero = 1;
        $nomenclatura = $letra . str_pad($numero, 2, '0', STR_PAD_LEFT);

        //Comprueba que el id no este registrado en la base de datos
        // Verificar si la nomenclatura ya existe en la base de datos
        $opciones = Jurado::where('Id_jurado', $nomenclatura)->get();

        while ($opciones->count() > 0) {
            $numero++; // Incrementar el número
            $nomenclatura = $letra . str_pad($numero, 2, '0', STR_PAD_LEFT);
            $opciones = Jurado::where('Id_jurado', $nomenclatura)->get();
        }
        //Guardar la informacion en jurado 
        $jurado = new Jurado();
        $jurado->Id_jurado = $nomenclatura;
        $jurado->Id_persona = $idGenerada2;
        $jurado->RFC = $rfc;
        
        $jurado->save();

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
        return redirect()->route('jurado.index')->with('success', 'Jurado registrado correctamente ');

    }
}
