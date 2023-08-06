<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Usuario;
use App\Models\Estudiante;
use App\Services\VerificarCorreoServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class liderController extends Controller
{

    protected $verificarCorreoService;

    public function __construct(VerificarCorreoServices $verificarCorreoService)
    {
        $this->verificarCorreoService = $verificarCorreoService;
    }

    public function index()
    {
        return view('lider.lider');
    }

    public function store(Request $request)
    {

        $nombre = request()->input('nombre');
        $apellidop = request()->input('apellidoP');
        $apellidom = request()->input('apellidoM');
        $matricula = request()->input('matricula');
        $correo = request()->input('correo');
        $nivel = request()->input('nivel');

        if ($this->verificarCorreoService->verificarCorreoExistente($correo)) {
            return redirect()->route('lider.lider')->with('error', 'El correo ya está registrado. Intente con otro.');
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
        $persona->Correo_electronico = $correo;

        // Asignar otros valores necesarios
        $usuario = new Usuario();
        $usuario->Id_usuario = $idGenerada2;
        $usuario->Nombre_usuario = $correo;
        $usuario->Contrasena = $hash;
        $usuario->Id_persona = $idGenerada2;
        $usuario->Id_rol="ROL02";

        $estudiante = new Estudiante();
        $estudiante->Matricula = $matricula;
        $estudiante->Id_persona = $idGenerada2;
        $estudiante->Id_nivel = $nivel;

        $persona->save();
        
        $estudiante->save();

        // Guardar la persona en la base de datos
         //Enviamos el correo con la clave para que pueda hacer su login 
         $subject = "Datos de Login";
         $for = $correo;
         
         $data = [
             'contraena' => $contrasena,
             'correo' => $correo,
             // Agrega más variables aquí si es necesario
         ];
         
         Mail::send('email', $data, function($msj) use($subject, $for) {
             $msj->from("hectoralr21@gmail.com", "Datos Login");
             $msj->subject($subject);
             $msj->to($for);
         });

         //Se guarda 
        $usuario->save();

        // Redireccionar a la página de listar para mostrar la tabla actualizada
        return redirect()->route('lider.index')->with('success', 'Lider registrado correctamente');

    }
}
