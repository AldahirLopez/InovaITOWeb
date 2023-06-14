<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Asesor;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AsesorController extends Controller
{

    public function index()
    {
        return view('asesores.asesores');
    }

    public function store(Request $request)
    {

        $nombre = request()->input('nombres');
        $apellidop = request()->input('apellidoPaterno');
        $apellidom = request()->input('apellidoMaterno');
        $correo = request()->input('correo');

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

        // Guardar la persona en la base de datos
        $persona->save();

        // Guarda en el asesor en la base de datos
        $asesor = new Asesor();


        // Redireccionar a la página de listar para mostrar la tabla actualizada
        return view('lider.lider');
    }
}
