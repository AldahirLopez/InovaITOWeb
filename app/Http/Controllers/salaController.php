<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Jurado;
use App\Models\Moderador;
use App\Models\sala;
use Illuminate\Support\Facades\DB;

class salaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = sala::all();
        return view('sala.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurados = Jurado::all();
        $moderadores = Moderador::all();
        return view('sala.agregar', compact('jurados', 'moderadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $nomenclatura = '';
        $nomenclaturaExistente = true;

        while ($nomenclaturaExistente) {
            $numeroAleatorio = str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT);
            $nomenclatura = "SALA" . $numeroAleatorio;

            $nomenclaturaExistente = sala::where('Id_sala', $nomenclatura)->exists();
        }

        $Sala = new sala();
        $Sala->Id_sala = $nomenclatura;
        $Sala->Nombre_sala = $request->nombre;
        $Sala->Lugar = $request->lugar;

        $Sala->save();

        return redirect()->route('sala.index')->with('success', 'Sala registrada correctamente');
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

        $sala = sala::where('Id_sala', $id)->first();

        if ($sala != null) {

            sala::where('Id_stand', $sala->Id_stand)->delete();
            DB::table('sala')
                ->where('Id_sala', $sala->Id_sala)
                ->delete();
        }

        return redirect()->route('sala.index')->with('delete', 'Sala eliminada correctamente');
    }
}
