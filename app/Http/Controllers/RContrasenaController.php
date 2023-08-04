<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            $contrasenaSinHash = Hash::make($usuario->Contrasena);

            echo "Contraseña sin cifrar: " . $contrasenaSinHash;
        } else {
            echo "Usuario no encontrado.";
        }
    }
}
