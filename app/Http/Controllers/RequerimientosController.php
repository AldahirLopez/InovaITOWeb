<?php

namespace App\Http\Controllers;

use App\Models\Requerimientos;
use Illuminate\Http\Request;

class RequerimientosController extends Controller
{

    public function index()
    {
        $requerimientos = Requerimientos::all();
        return view('proyectos.requerimientos',compact('requerimientos'));
    }
    public function store(Request $request)
    {
        // Accede a los valores de los checkbox mediante el método input() del objeto Request.
        $requerimiento1 = $request->input('requerimiento1', false); // false es un valor por defecto si el checkbox no está seleccionado
        $requerimiento2 = $request->input('requerimiento2', false);
        $requerimiento3 = $request->input('requerimiento3', false);
        $requerimiento4 = $request->input('requerimiento4', false);

        // Realiza aquí las operaciones necesarias con los valores obtenidos.

        // Por último, puedes redireccionar a otra página o mostrar un mensaje de éxito.
        return redirect()->route('ruta_destino')->with('success', 'Requerimientos guardados exitosamente');
    }
}
