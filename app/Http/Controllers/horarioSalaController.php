<?php

namespace App\Http\Controllers;

use App\Models\asignarHSala;
use App\Models\Ficha_Tecnica;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\horario;
use App\Models\sala;
use Illuminate\Support\Facades\DB;

class horarioSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = asignarHSala::all();
        
        return view('horarioSala.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $proyectos = Ficha_Tecnica::all();
        $salas = sala::all();
        return view('horarioSala.agregar', compact('proyectos', 'salas'));
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
            return redirect()->route('horariosala.index')->with('success', 'Horario de sala registrado correctamente');
        } else {
            return redirect()->route('horariosala.index')->with('error', 'Horario de sala no registrado correctamente');
            
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
        $horario = asignarHSala::where('Id_sala', $id)->first();
        return view('horarioSala.editar', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('asignarHSala')
            ->where('Id_sala', $id)
            ->update([
                'Fecha' => $request->fecha,
                'Hora_inicio' => $request->horainicio,
                'Hora_final' => $request->horafin
            ]);



        return redirect()->route('horariosala.index')->with('update', 'Horario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($horariosala)
    {
        // Retrieve the HorarioSala instance and delete it based on $horariosala
        // You might need to adjust your model and primary key based on your schema
        $sala = asignarHSala::findOrFail($horariosala);
        $sala->delete();
    
        // Optionally, you can redirect back to the listing page
        return redirect()->route('horariosala.index')->with('success', 'Horario eliminado exitosamente.');
    }
}
