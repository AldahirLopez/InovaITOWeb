<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Ficha_Tecnica;
use Illuminate\Http\Request;

class Ficha_tController extends Controller
{

    public function index()
    {
        return view('proyectos.ficha_t');
    }

    public function generarIdFicha() {
        $nomenclatura = 'F';
        $nomenclatura .= date('Y');
        $nomenclatura .= date('m');
        $nomenclatura .= date('d');
    
        $numerosAleatorios = array();
    
        while (count($numerosAleatorios) < 4) {
            $numero = mt_rand(0, 9);
    
            if (!in_array($numero, $numerosAleatorios)) {
                $numerosAleatorios[] = $numero;
            }
        }
    
        $nomenclatura .= implode('', $numerosAleatorios);
    
        return $nomenclatura;
    }
    public function store(Request $request)
    {

        $categoria = request()->input('nomcategoriabre');
        $nombreCorto = request()->input('nombreCorto');
        $nombreDescriptivo = request()->input('nombreDescriptivo');
        $areaAplicacion = request()->input('areaAplicacion');
        $naturalezaTecnica = request()->input('naturalezaTecnica');
        $objetivoProyecto = request()->input('objetivoProyecto');
        $descripcionGeneral = request()->input('descripcionGeneral');
        $resultadosProyecto = request()->input('resultadosProyecto');

        // Crear una nueva instancia de la clase Persona y asignar los valores
        $ficha = new Ficha_Tecnica();
        $ficha->Id_fichaTecnica = $this->generarIdFicha();
        $ficha->Nombre_corto = $nombreCorto;
        $ficha->Nombre_proyecto = $nombreDescriptivo;
        $ficha->Objetivo = $objetivoProyecto;
        $ficha->Descripcion_general = $descripcionGeneral;
        $ficha->Prospecto_resultados = $resultadosProyecto;
        $ficha->Id_naturalezaTecnica = $naturalezaTecnica;
        $ficha->Id_area = $areaAplicacion;
        
        //Guardamos la ficha en la base de datos

        $ficha->save();

        // Redireccionar a la página de listar para mostrar la tabla actualizada
        return view('proyectos.ficha_t');
    }
}
