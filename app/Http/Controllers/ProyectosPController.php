<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Categorias;
use App\Models\Estudiante;
use App\Models\Ficha_Tecnica;
use App\Models\Persona;
use App\Models\Proyecto;
use App\Models\ProyectoParticipante;
use App\Models\proyectoAsesor;
use App\Models\Usuario;
use App\Models\Asesor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ProyectosPController extends Controller
{
    public function index()
    {


            $usuario = session('usuario');
            $idpersona = $usuario->Id_persona;
            $usuarioLogueado=Usuario::where('Id_persona',$idpersona)->first();

            $asesor=Asesor::Where('Id_persona',$idpersona)->first();

          
            $ProyectosPendientes=proyectoAsesor::where('Id_asesor',$asesor->Id_asesor)->get();
            

            return view('proyectos.proyectos_pendientes',compact('ProyectosPendientes'));
    }

    public function buscarPorArea($id_area)
    {
        // Buscar el registro en la tabla Ficha_Tecnica donde el campo Id_area coincida con $id_area
        $fichaTecnica = Ficha_Tecnica::where('Id_area', $id_area)->first();

        // Verificar si se encontró un registro válido en Ficha_Tecnica
        if ($fichaTecnica) {
            // Obtener el Id_categoria desde el objeto $fichaTecnica
            $id_categoria = $fichaTecnica->Id_categoria;

            // Buscar en la tabla categoria utilizando el Id_categoria obtenido
            $categoria = Categorias::find($id_categoria);

            // Aquí puedes utilizar la variable $categoria que contiene el registro correspondiente de la tabla categoria.
            // Por ejemplo, para obtener el nombre de la categoría:
            $nombre_categoria = $categoria->Nombre_categoria;

            // Y cualquier otro dato que necesites de la tabla categoria.
        } else {
            // Si no se encuentra un registro válido en Ficha_Tecnica, puedes manejarlo adecuadamente.
            // Por ejemplo, mostrar un mensaje de error o realizar alguna otra acción.
        }
    }
    public function pdf($id){

        $proyecto=Proyecto::where('Folio',$id)->first();
        
        $pdf =PDF::loadView('proyectos.pdf',['proyecto'=>$proyecto]);
      
        return $pdf->stream();
      
       // return view('proyectos.pdf',compact('proyecto'));
    }


}
