<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MaintInReview;
use App\Models\Contract;
use App\Models\Sparepart;

class FileUploadController extends Controller
{
    public function fileupload()
    {
        return view('fileupload.view_fileupload');
    }

    public function uploadExcel(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'file' => 'required|mimes:xlsx',
            'tipoArchivo' => 'required|in:mantenimiento,contratos,repuestos'
        ]);

        // Get the value of 'tipoArchivo' from the request
        $tipoArchivo = $request->input('tipoArchivo');

        // Retrieve the uploaded file from the request
        $file = $request->file('file');

        // Get the path of the uploaded file
        $filePath = $file->getPathname();

        // Load the Excel file using Maatwebsite\Excel package
        $data = Excel::load($filePath, function($reader) {
            // This is a callback function that can be used for additional processing if needed
        })->get();

        // Check if the loaded data is empty
        if ($data->isEmpty()) {
            // If the data is empty, redirect back with a danger message
            return redirect()->back()->with('danger', 'Excel file is empty.');
        }

        // Process each row of data based on the 'tipoArchivo' value
        switch ($tipoArchivo) {
            case 'mantenimiento':
                // Iterate over each row of data and create a new record in the 'MaintInReview' model
                foreach ($data as $row) {
                    MaintInReview::create([
                        'tipo_de_revisión' => $row->tipo_de_revisión,
                        'ascensor' => $row->ascensor,
                        'dirección' => $row->dirección,
                        'provincia' => $row->provincia,
                    ]);
                }
                break;
            case 'contratos':
                // Iterate over each row of data and create a new record in the 'Contract' model
                foreach ($data as $row) {
                    Contract::create([
                        'ascensor' => $row->ascensor,
                        'fecha_de_propuesta' => $row->fecha_de_propuesta,
                        'monto_de_propuesta' => $row->monto_de_propuesta,
                    ]);
                }
                break;
            case 'repuestos':
                // Iterate over each row of data and create a new record in the 'Sparepart' model
                foreach ($data as $row) {
                    Sparepart::create([
                        'nombre' => $row->nombre,
                        'precio' => $row->precio,
                    ]);
                }
                break;
            default:
                // If an invalid 'tipoArchivo' value is provided, redirect back with a danger message
                return redirect()->back()->with('danger', 'Invalid file type selected.');
        }

        // If everything is successful, redirect back with a success message
        return redirect()->back()->with('success', 'Excel data imported successfully.');
    }

}
