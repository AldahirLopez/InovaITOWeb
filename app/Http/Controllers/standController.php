<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stand;
use App\Models\Horario;
use App\Models\evaluacionStand;
use App\Models\asignarHStand;
use Illuminate\Support\Facades\DB;

class standController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stands = stand::all();
        return view('stand.index', compact('stands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stand.agregar');
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
            $nomenclatura = "STAND" . $numeroAleatorio;

            $nomenclaturaExistente = stand::where('Id_stand', $nomenclatura)->exists();
        }


        $Stand = new stand();
        $Stand->Id_stand = $nomenclatura;
        $Stand->Lugar = $request->lugar;
        $Stand->save();
        return redirect()->route('stand.index')->with('success', 'Stand registrado correctamente');
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
        $stand = stand::where('Id_stand', $id)->first();


        if ($stand != null) {


            evaluacionStand::where('Id_stand', $stand->Id_stand)->delete();
            asignarHStand::where('Id_stand', $stand->Id_stand)->delete();

            DB::table('stand')
                ->where('Id_stand', $stand->Id_stand)
                ->delete();
        }

        return redirect()->route('stand.index')->with('delete', 'Stand eliminada correctamente');
    }
}
