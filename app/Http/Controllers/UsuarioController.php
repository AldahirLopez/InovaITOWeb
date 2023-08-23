<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $correo = $request->input('email');
        $con = $request->input('password');

        $usuario = Usuario::where('Nombre_usuario', $correo)->first();

        if ($usuario) {
            if (password_verify($con, $usuario->Contrasena)) {
                $idpersona = $usuario->Id_persona;
                $consulta = Persona::where('Id_persona', $idpersona)->first();
                Session::put('usuario', $consulta);
                return view('home');
            } else {
                return redirect('/')->with('passoword', 'Contraseñas no coinciden');
            }
        } else {
            return redirect('/')->with('correo', 'Usuario no registrado');
        }
    }
}

