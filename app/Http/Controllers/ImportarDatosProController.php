<?php

namespace App\Http\Controllers;

use App\Imports\FichaTecnicaImport;

use Illuminate\Http\Request;

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

        // Importar los datos desde el archivo Excel utilizando la clase de importación
        Excel::import(new FichaTecnicaImport, $file);

        return redirect()->back()->with('success', 'Datos importados correctamente');
    }
}
