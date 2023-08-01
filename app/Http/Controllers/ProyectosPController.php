<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Categorias;
use App\Models\Estudiante;
use App\Models\Ficha_Tecnica;
use App\Models\Persona;
use App\Models\Proyecto;
use App\Models\ProyectoParticipante;
use Illuminate\Http\Request;

class ProyectosPController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::all(); // Obtener todos los proyectos desde la base de datos

        $datosFichaTecnica = [];

        // Obtener los datos de cada ficha técnica asociada a los proyectos
        foreach ($proyectos as $proyecto) {
            $idFichaTecnica = $proyecto->Id_fichaTecnica;
            $fichaTecnica = Ficha_Tecnica::where('Id_fichaTecnica', $idFichaTecnica)->first();
            // Agregar los datos de la ficha técnica al array
            if ($fichaTecnica) {
                $idproyecto = $proyecto->Folio;
                $datosFichaTecnica[$idFichaTecnica] = $fichaTecnica;
                $participante = ProyectoParticipante::where('Folio', $idproyecto)->first();
                // Obtener el Id_categoria desde la ficha técnica
                $Id_area = $fichaTecnica->Id_area;

                // Buscar en la tabla Tabla_Categoria utilizando el Id_categoria
                $area = Area::where('Id_area', $Id_area)->first();

                // Obtener el Nombre_categoria desde el objeto $categoria
                $id_categoria = $area->Id_categoria; // Asegúrate de tener el nombre correcto del campo en el modelo Tabla_Categoria.
                $categoria = Categorias::where('Id_categoria', $id_categoria)->first();
                // Agregar el Nombre_categoria al array de datos
                $datosFichaTecnica[$idFichaTecnica]['nombre_categoria'] = $categoria->Nombre_categoria;
                if ($participante) {
                    $maparticipante = Estudiante::where('Matricula', $participante->Matricula)->first();

                    if ($maparticipante) {
                        $id_persona = Persona::where('Id_persona', $maparticipante->Id_persona)->first();

                        if ($id_persona) {
                            $datosFichaTecnica[$idFichaTecnica]['participantes'] = $id_persona->Nombre_persona;
                        } else {
                            $datosFichaTecnica[$idFichaTecnica]['participantes'] = 'N/A';
                        }
                    } else {
                        $datosFichaTecnica[$idFichaTecnica]['participantes'] = 'N/A';
                    }
                } else {
                    $datosFichaTecnica[$idFichaTecnica]['participantes'] = 'N/A'; // O cualquier valor predeterminado si no hay participantes.
                }
            }
        }

        return view('proyectos.proyectos_pendientes', ['proyectos' => $proyectos, 'datosFichaTecnica' => $datosFichaTecnica]);
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
}
