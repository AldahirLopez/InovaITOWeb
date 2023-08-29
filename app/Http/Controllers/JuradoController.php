<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Jurado;
use App\Models\Persona;
use App\Models\Preferencia;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class JuradoController extends Controller
{

    public function index()
    {
        $jurados = Jurado::all();
        return view('jurado.index', compact('jurados'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('jurado.jurado',compact('areas'));
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
        $nomenclatura = $letra . $idGenerada2;
        //Guardar la informacion en jurado 
        $jurado = new Jurado();
        $jurado->Id_jurado = $nomenclatura;
        $jurado->Id_persona = $idGenerada2;
        $jurado->RFC = $rfc;


        $jurado->save();

        //Guardamos la preferencia del jurado
        $preferencia=request()->input('area');

        $areapreferencia = new Preferencia();
        $areapreferencia->Id_jurado = $jurado->Id_jurado;
        $areapreferencia->Id_area = $preferencia;

        $areapreferencia->save();
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


    public function destroy($id)
    {

        $jurado = Jurado::where('Id_jurado', $id)->first();


        DB::table('jurado')
            ->where('Id_jurado', $jurado->Id_jurado)
            ->delete();


        DB::table('usuario')
            ->where('Id_persona', $jurado->persona->Id_persona)
            ->delete();

        DB::table('persona')
            ->where('Id_persona', $jurado->persona->Id_persona)
            ->delete();


        return redirect()->route('jurado.index')->with('delete', 'Jurado eliminado correctamente');
    }
}
