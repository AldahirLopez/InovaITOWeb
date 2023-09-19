<?php

namespace App\Http\Controllers;

use App\Imports\FichaTecnicaImport;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Facades\Excel;

class ImportarDatosProController extends Controller
{
    public function index()
    {
        return view('regional.importarDatosPro');
    }

    public function importarDatos(Request $request)
    {
        // Validar y procesar el archivo Excel
        $this->validate($request, [
            'excel_file' => 'required|mimes:xlsx,xls', // Validación para asegurar que sea un archivo Excel
        ]);

        $file = $request->file('excel_file');

        // Cargar el archivo Excel
        $spreadsheet = IOFactory::load($file);

        // Seleccionar la hoja de trabajo (worksheet)
        $worksheet = $spreadsheet->getActiveSheet();

        // Obtener los datos de las filas como un arreglo
        $data = $worksheet->toArray();

        // Iterar a través de las filas del archivo Excel y procesar los datos
        foreach ($data as $row) {
            // Acceder a los datos de cada columna según el índice
            $idFicha = $row[2];
            $cortonombre = $row[3];
            $nombredescriptivo = $row[4];
            $nivel = $row[5];
            $categoria = $row[6];
            $idcategoria='null';
            // Asignar la categoría basada en la columna 'categoria'
            switch ($categoria) {
                case 'Sector Agroalimentario':
                    $idcategoria = 'CAT01';
                    break;
                case 'Industria Eléctrica y Electrónica':
                    $idcategoria = 'CAT02';
                    break;
                case 'Electromovilidad y Ciudades Inteligentes':
                    $idcategoria = 'CAT03';
                    break;
                case 'Servicios para la Salud':
                    $idcategoria = 'CAT04';
                    break;
                case 'Industrias Creativas':
                    $idcategoria = 'CAT05';
                    break;
                case 'Cambio Climático':
                    $idcategoria = 'CAT06';
                    break;
                default:
                    $idcategoria; // Mantener el valor actual en otros casos
            }

            $fichaTecnica = new \App\Models\Ficha_Tecnica([
                'Id_fichaTecnica' => $idFicha,
                'Nombre_corto' => $cortonombre,
                'Nombre_proyecto' => $nombredescriptivo,
                'Id_nivel' => $nivel === 'Licenciatura' ? 'NIV02' : 'NIV01',
                'Id_categoria' => $idcategoria,
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

        }

        return redirect()->back()->with('success', 'Datos importados correctamente');
    }
}
