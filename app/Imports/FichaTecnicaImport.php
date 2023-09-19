<?php

namespace App\Imports;

use App\Ficha_Tecnica;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Area;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Proyecto;
use App\Models\ProyectoParticipante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FichaTecnicaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Asignar la categoría basada en la columna 'categoria'
        switch ($row['categoria']) {
            case 'Sector Agroalimentario':
                $categoria = 'CAT01';
                break;
            case 'Industria Eléctrica y Electrónica':
                $categoria = 'CAT02';
                break;
            case 'Electromovilidad y Ciudades Inteligentes':
                $categoria = 'CAT03';
                break;
            case 'Servicios para la Salud':
                $categoria = 'CAT04';
                break;
            case 'Industrias Creativas':
                $categoria = 'CAT05';
                break;
            case 'Cambio Climático':
                $categoria = 'CAT06';
                break;
            default:
                $categoria = $row['categoria']; // Mantener el valor actual en otros casos
        }

        $idFicha = $row['folio'];
        $fichaTecnica = new \App\Models\Ficha_Tecnica([
            'Id_fichaTecnica' => $idFicha,
            'Nombre_corto' => $row['cortonombre'] ,
            'Nombre_proyecto' => $row['nombredescriptivo'] ,
            'Id_nivel' => $row['nivel'] === 'Licenciatura' ? 'NIV02' : 'NIV01',
            'Id_categoria' => $categoria,
        ]);

        // Guardar la instancia en la base de datos        
        $fichaTecnica->save();

        //Crear variable de tipo proyecto
        $proyecto = new Proyecto();
        $proyecto->Folio = $idFicha;
        $proyecto->Plan_negocio = "default";
        $proyecto->Id_fichaTecnica = $idFicha;

        //Guardamos primero proyecto 
        $proyecto->save();

        // Devolver la instancia creada
        return $fichaTecnica;
    }
}
