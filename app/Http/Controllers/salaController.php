<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\sala;

class salaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas=sala::all();
        return view('sala.index',compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       return view('sala.agregar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Sala=new sala();
        $Sala->Id_sala=$request->id_sala;
        $Sala->Nombre_sala=$request->nombre;
        $Sala->Lugar=$request->lugar;

        $Sala->save();

        return redirect()->route('sala.index')->with('success','Sala registrada correctamente');


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
