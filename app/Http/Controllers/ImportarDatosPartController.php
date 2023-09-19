<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportarDatosPartController extends Controller
{

    public function index()
    {
        return view('regional.importarDatosPart');
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
            $idfolio = $row[0];
            $nombre = $row[1];
            $apellido1 = $row[2];
            $apellido2 = $row[3];

            //Generar ID Unico
            $datosUsuario = 'PART'. $nombre . $apellido1 . $apellido2 . $idfolio;
            $idGenerada = substr(sha1($datosUsuario), 0, 10);
            $idGenerada2 = strtolower($idGenerada);

            $persona = new \App\Models\Persona([
                'Id_persona' => $idGenerada2,
                'Nombre_persona' => $nombre,
                'Apellido1' => $apellido1,
                'Apellido2' => $apellido2,
            ]);

            // Guardar la instancia en la base de datos        
            $persona->save();

            //Se compara el folio para agregarlo en Proyecto Participante
            $proyectoparticipante = new \App\Models\ProyectoParticipante([
                'Idpersona' => $idGenerada2,
                'Folio' => $idfolio,
            ]);

            // Guardar la instancia en la base de datos        
            $proyectoparticipante->save();
        }

        return redirect()->back()->with('success', 'Datos importados correctamente');
    }
}
