<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\stand;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportarDatosStandController extends Controller
{

    public function index()
    {
        return view('regional.importarDatosStand');
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
            $horario = $row[0];
            $nombre = $row[1];
            $stand_lugar = $row[2];
            $ubi = $row[3];

            // Dividir $horario en hora inicial y hora final
            list($hora_inicio, $hora_final) = explode('-', $horario);

            // Obtener el folio correspondiente al nombre desde la tabla fichatecnica
            $fichatecnica = \App\Models\FIcha_tecnica::where('Nombre_corto', $nombre)->first();
            $proyecto = ($fichatecnica) ? \App\Models\Proyecto::where('Folio', $fichatecnica->Id_fichaTecnica)->first() : null;

            // Crea una nueva instancia de Stand y asigna la nomenclatura
            $nomenclatura = '';
            $nomenclaturaExistente = true;

            while ($nomenclaturaExistente) {
                $numeroAleatorio = str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT);
                $nomenclatura = "STAND" . $numeroAleatorio;

                // Verificar si la nomenclatura existe en la tabla stand
                $nomenclaturaExistente = \App\Models\Stand::where('Id_stand', $nomenclatura)->exists();
            }

            $stand = new \App\Models\Stand();
            $stand->Id_stand = $nomenclatura;
            $stand->Lugar = "($stand_lugar) $ubi"; // Reemplaza "PLAZA CIVICA" según tu necesidad


            // Guardar el registro en la base de datos
            $stand->save();

            // Obtener el ID del stand creado
            $id_stand = $stand->Id_stand;

            // Crear un nuevo objeto asignarHStand y asignar los valores
            $standhorario = new \App\Models\asignarHStand([
                'Hora_inicio' => trim($hora_inicio),
                'Hora_final' => trim($hora_final),
                'Fecha' => date('Y-m-d'), // Fecha actual
                'Folio' => ($proyecto) ? $proyecto->Folio : null, // Folio obtenido de fichatecnica (maneja null si no se encontró $proyecto)
                'Id_stand' => $id_stand, // ID obtenido de stand
            ]);

            // Guardar el objeto $standhorario en la base de datos
            $standhorario->save();
        }

        return redirect()->back()->with('success', 'Datos importados correctamente');
    }
}
