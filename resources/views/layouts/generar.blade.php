<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Generar
{
    /**
     * Generar contraseña aleatoria.
     *
     * @return string
     */
    public static function contrasenaAleatoria()
    {
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$*-_+\\|./?';
        return Str::random(8, $caracteres);
    }

    /**
     * Generar ID único para persona mediante el nombre completo y correo electrónico.
     *
     * @param string $nombres
     * @param string $apellidoPaterno
     * @param string $apellidoMaterno
     * @param string $correo
     * @return string
     */
    public static function idPersona($nombres, $apellidoPaterno, $apellidoMaterno, $correo)
    {
        $datosUsuario = $nombres . $apellidoPaterno . $apellidoMaterno . $correo;
        $idGenerada = substr(sha1($datosUsuario), 0, 10);
        return strtolower($idGenerada);
    }

    /**
     * Generar hash de contraseña en BCRYPT.
     *
     * @param string $contrasena
     * @return string
     */
    public static function hashContrasena($contrasena)
    {
        return Hash::make($contrasena);
    }

    /**
     * Comparar una contraseña en texto plano con una contraseña encriptada con Bcrypt.
     *
     * @param string $contrasena
     * @param string $contrasenaHash
     * @return bool
     */
    public static function compararContrasena($contrasena, $contrasenaHash)
    {
        return Hash::check($contrasena, $contrasenaHash);
    }
}
