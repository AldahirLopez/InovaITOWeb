<?php

namespace App\Http\Controllers;

use App\Models\asignarHSala;
use App\Models\Ficha_Tecnica;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\horario;
use App\Models\sala;
use Illuminate\Support\Facades\DB;

class horarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = asignarHSala::all();
        
        return view('horario.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $proyectos = Ficha_Tecnica::all();
        $salas = sala::all();
        return view('horario.agregar', compact('proyectos', 'salas'));
    }
    public function generarIdFHorario()
    {
        $nomenclatura = 'SALA';


        $numerosAleatorios = array();

        while (count($numerosAleatorios) < 2) {
            $numero = mt_rand(0, 9);

            if (!in_array($numero, $numerosAleatorios)) {
                $numerosAleatorios[] = $numero;
            }
        }

        $nomenclatura .= implode('', $numerosAleatorios);

        return $nomenclatura;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $horariosala = new asignarHSala();
        $horariosala->Id_sala = $request->id_sala;

        $horariosala->Hora_inicio = $request->hora1;
        $horariosala->Hora_final = $request->hora2;
        $horariosala->Fecha = $request->fecha;


        //Consulta del folio del proyecto 
        $proyecto = Proyecto::where('Folio', $request->id_proyecto)->first();

        if ($proyecto!=null) {
            $horariosala->Folio = $proyecto->Folio;
            $horariosala->save();
            return redirect()->route('horario.index')->with('success', 'Horario de sala registrado correctamente');
        } else {
            return redirect()->route('horario.index')->with('error', 'Horario de sala no registrado correctamente');
            
        }



        
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
        $horario = horario::where('Id_horario', $id)->first();
        return view('horario.editar', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('horario')
            ->where('Id_horario', $id)
            ->update([
                'Fecha' => $request->fecha,
                'Hora' => $request->hora
            ]);



        return redirect()->route('horario.index')->with('update', 'Horario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
