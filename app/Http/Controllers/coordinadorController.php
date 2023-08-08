<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\persona;
use App\Models\Usuario;
use App\Models\coordinador;
use App\Models\tecnologico;

class coordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordinadores=coordinador::all();
       return view('coordinador.index',compact('coordinadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tecnologicos=tecnologico::all();
        return view('coordinador.agregar',compact('tecnologicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nombre = request()->input('nombre');
        $apellidop = request()->input('apellidoP');
        $apellidom = request()->input('apellidoM');
        $telefono = request()->input('telefono');
        $correo = request()->input('correo');
        $identificacion = request()->input('identificacion');
        $curp = request()->input('curp');

        //datos del coordinador
        $id_coordinador = request()->input('id_coordinador');
        $clave_tecnologico=request()->input('Clave_tecnologico');

        $datosUsuario = $nombre . $apellidop . $apellidom . $correo;
        $idGenerada = substr(sha1($datosUsuario), 0, 10);
        $idGenerada2 = strtolower($idGenerada);


        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$*-+\|./?';
        $contrasena = '';
        for ($i = 0; $i < 8; $i++) {
            $index = random_int(0, strlen($caracteres) - 1);
            $contrasena .= $caracteres[$index];
        }

        $hash = password_hash($contrasena, PASSWORD_BCRYPT);

        $persona = new Persona();
        $persona->Id_persona = $idGenerada2;
        $persona->Nombre_persona = $nombre;
        $persona->Apellido1 = $apellidop;
        $persona->Apellido2 = $apellidom;
        $persona->Correo_electronico = $correo;
        $persona->Telefono = $telefono;
        $persona->Num_ine = $identificacion;
        $persona->Curp = $curp;
        $persona->save();


        // Asignar otros valores necesarios
        $usuario = new Usuario();
        $usuario->Id_usuario = $idGenerada2;
        $usuario->Nombre_usuario = $correo;
        $usuario->Contrasena = $hash;
        $usuario->Id_persona = $idGenerada2;
        $usuario->Id_rol="ROL01";
        $usuario->save();

        //Agregamos el coordinador

        $Coordinador=new coordinador();
        $Coordinador->Id_coordinador=$id_coordinador;
        $Coordinador->Id_persona=$idGenerada2;
        $Coordinador->Clave_tecnologico=$clave_tecnologico;
        $Coordinador->save();



        return redirect()->route('coordinador.index')->with('success', 'Coordinador registrado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
