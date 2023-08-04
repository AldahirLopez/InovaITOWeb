<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\horario;
use Illuminate\Support\Facades\DB;
class horarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios=horario::all();
        return view('horario.index',compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        

        return view('horario.agregar');


    }
    public function generarIdFHorario() {
        $nomenclatura = 'HOR0';
   
    
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
        $horario=new horario();
        $horario->Id_horario=$this->generarIdFHorario();
        $horario->Fecha=$request->fecha;
        $horario->Hora=$request->hora;
        $horario->save();
  
        return redirect()->route('horario.index')->with('success', 'Horario registrado correctamente');

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
        $horario=horario::where('Id_horario',$id)->first();
        return view('horario.editar',compact('horario'));
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
