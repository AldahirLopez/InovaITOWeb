<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RContrasenaController extends Controller
{
    public function index()
    {
        return view('loginRECUPERAR');
    }

    public function RecuperarContrasena(Request $request)
    {
        $correo = $request->input('email');

        $usuario = Usuario::where('Nombre_usuario', $correo)->first();
        if ($usuario) {
            //Metodo
            $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$*-+\|./?';
            $contrasena = '';
            for ($i = 0; $i < 8; $i++) {
                $index = random_int(0, strlen($caracteres) - 1);
                $contrasena .= $caracteres[$index];
            }


            $hash = password_hash($contrasena, PASSWORD_BCRYPT);

            // Asignar otros valores necesarios

            Usuario::where('Nombre_usuario', $correo)->update(['Contrasena' => $hash]);


            //Enviamos el correo con la clave para que pueda hacer su login 
            $subject = "Nuevos datos de inicio de sesion";
            $for = $correo;

            $data = [
                'contraena' => $contrasena,
                'correo' => $correo,
                // Agrega más variables aquí si es necesario
            ];

            Mail::send('email', $data, function ($msj) use ($subject, $for) {
                $msj->from("hectoralr21@gmail.com", "Nuevos datos de inicio de sesion");
                $msj->subject($subject);
                $msj->to($for);
            });

            //Se guarda 
            $usuario->save();

            return redirect()->route('recuperar.index')->with('success', 'Contraseña Enviada Correctamente');
        } else {
            return redirect()->route('recuperar.index')->with('error', 'Usuario no encontrado');
        }
    }
}
