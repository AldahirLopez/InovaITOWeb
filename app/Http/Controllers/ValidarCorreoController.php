<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;


class ValidarCorreoController extends Controller
{
    public function ChecarCorreo(Request $request)
    {
        $email = $request->input('email');
        $user = Usuario::where('Nombre_usuario', $email)->first();

        if ($user) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}





