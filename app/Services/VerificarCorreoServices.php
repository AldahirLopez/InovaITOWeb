<?php

namespace App\Services;

use App\Models\Usuario;

class VerificarCorreoServices
{
    public function verificarCorreoExistente($correo)
    {
        return Usuario::where('Nombre_usuario', $correo)->exists();
    }
}
