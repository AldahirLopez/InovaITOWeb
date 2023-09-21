<?php

namespace App\Http\Controllers;

use App\Models\asignarHSala;
use App\Models\asignarHStand;
use App\Models\evaluacionStand;
use App\Models\Ficha_Tecnica;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\horario;
use App\Models\sala;
use App\Models\stand;
use Illuminate\Support\Facades\DB;

class horarioStandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stands = asignarHStand::all();

        return view('horarioStand.index', compact('stands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $proyectos = Ficha_Tecnica::all();
        $stands = stand::all();
        return view('horariostand.agregar', compact('proyectos', 'stands'));
    }
    public function generarIdFHorario()
    {
        $nomenclatura = 'STAND';


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
        $horariostand = new asignarHStand();
        $horariostand->Id_stand = $request->id_stand;
        $horariostand->Hora_inicio = $request->hora1;
        $horariostand->Hora_final = $request->hora2;
        $horariostand->Fecha = $request->fecha;

        // Verificar si las horas ya están ocupadas en el stand
        $horarioExistenteStand = asignarHStand::where('Id_stand', $horariostand->Id_stand)
            ->where(function ($query) use ($horariostand) {
                $query->where(function ($q) use ($horariostand) {
                    $q->where('Hora_inicio', '<=', $horariostand->Hora_inicio)
                        ->where('Hora_final', '>', $horariostand->Hora_inicio);
                })->orWhere(function ($q) use ($horariostand) {
                    $q->where('Hora_inicio', '<', $horariostand->Hora_final)
                        ->where('Hora_final', '>=', $horariostand->Hora_final);
                });
            })
            ->where('Fecha', $horariostand->Fecha)
            ->first();

        if ($horarioExistenteStand) {
            return redirect()->route('horariostand.index')->with('error', 'Las horas seleccionadas ya están ocupadas en este stand.');
        }

        // Consulta del folio del proyecto 
        $proyecto = Proyecto::where('Folio', $request->id_proyecto)->first();

        if ($proyecto != null) {
            // Validar si la nueva hora (Hora_inicio) está dentro del rango de horas
            $nuevaHora = $request->hora1;
            if ($nuevaHora >= $request->hora1 && $nuevaHora <= $request->hora2) {
                return redirect()->route('horariostand.index')->with('error', 'La hora ingresada está dentro del rango de horas existente.');
            }

            $horariostand->Folio = $proyecto->Folio;
            $horariostand->save();
            return redirect()->route('horariostand.index')->with('success', 'Horario de stand registrado correctamente');
        } else {
            return redirect()->route('horariostand.index')->with('error', 'Horario de stand no registrado correctamente');
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
        $horario = asignarHStand::where('Id_stand', $id)->first();
        return view('horarioStand.editar', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('asignarHStand')
            ->where('Id_stand', $id)
            ->update([
                'Fecha' => $request->fecha,
                'Hora_inicio' => $request->horainicio,
                'Hora_final' => $request->horafin
            ]);



        return redirect()->route('horariostand.index')->with('update', 'Horario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asignarHStand = asignarHStand::where('Id_stand', $id)->first();


        if ($asignarHStand != null) {


            evaluacionStand::where('Id_stand', $asignarHStand->Id_stand)->delete();
            asignarHStand::where('Id_stand', $asignarHStand->Id_stand)->delete();

            DB::table('stand')
                ->where('Id_stand', $asignarHStand->Id_stand)
                ->delete();
        }

        return redirect()->route('stand.index')->with('delete', 'Stand eliminada correctamente');
    
    }
}
