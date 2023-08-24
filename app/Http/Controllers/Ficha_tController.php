<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Estudiante;
use App\Models\Ficha_Tecnica;
use App\Models\Persona;
use App\Models\Proyecto;
use App\Models\ProyectoParticipante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Ficha_tController extends Controller
{

    public function index()
    {
        return view('proyectos.ficha_t');
    }

    public function generarIdFicha()
    {
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

    public function generarFolio()
    {
        $nomenfolio = 'PRO';

        $numerosAleatorios = array();

        while (count($numerosAleatorios) < 4) {
            $numero = mt_rand(0, 9);

            if (!in_array($numero, $numerosAleatorios)) {
                $numerosAleatorios[] = $numero;
            }
        }

        $nomenfolio .= implode('', $numerosAleatorios);

        return $nomenfolio;
    }


    public function store(Request $request)
    {

        $categoria = request()->input('categoria');
        $nombreCorto = request()->input('nombreCorto');
        $nombreDescriptivo = request()->input('nombreDescriptivo');
        $areaAplicacion = request()->input('areaAplicacion');
        $naturalezaTecnica = request()->input('naturalezaTecnica');
        $objetivoProyecto = request()->input('objetivoProyecto');
        $descripcionGeneral = request()->input('descripcionGeneral');
        $resultadosProyecto = request()->input('resultadosProyecto');
        // Generar el ID de la ficha técnica
        $idFicha = $this->generarIdFicha();

        // Asignar el mismo ID a la variable de folio
        $folio = $idFicha;

        // Crear una nueva instancia de la clase Persona y asignar los valores
        $ficha = new Ficha_Tecnica();
        $ficha->Id_fichaTecnica = $idFicha;
        $ficha->Nombre_corto = $nombreCorto;
        $ficha->Nombre_proyecto = $nombreDescriptivo;
        $ficha->Objetivo = $objetivoProyecto;
        $ficha->Descripcion_general = $descripcionGeneral;
        $ficha->Prospecto_resultados = $resultadosProyecto;
        $ficha->Id_naturalezaTecnica = $naturalezaTecnica;
        $ficha->Id_area = $areaAplicacion;
        //Guardamos la ficha tecnica 
        $ficha->save();
        //Crear variable de tipo proyecto
        $proyecto = new Proyecto();
        $proyecto->Folio = $folio;
        $proyecto->Plan_negocio = "default";
        $proyecto->Id_fichaTecnica = $idFicha;

        //Guardamos primero proyecto 
        $proyecto->save();
        //Guardamos la ficha en la base de datos
        $proyectoParticipante = new ProyectoParticipante();
        // Obtener el valor del ID de la persona desde la variable 'usuario' almacenada en la sesión
        $idPersona = Session::get('usuario')->Id_persona;
        // Buscar en la otra tabla utilizando el ID de la persona
        $informacionAdicional = Estudiante::where('Id_persona', $idPersona)->first();
        $proyectoParticipante->Folio = $folio;
        $proyectoParticipante->Matricula = $informacionAdicional->Matricula;

        $proyectoParticipante->save();


        // Redireccionar a la página de listar para mostrar la tabla actualizada

        return redirect()->route('proyectos.index')->with('success', 'Ficha Tecnica registrada ');
    }
}
