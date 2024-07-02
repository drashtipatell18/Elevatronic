<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MaintReviewImport;
use App\Imports\ContractImport;
use App\Imports\SparepartImport;

class FileUploadController extends Controller
{
    public function fileupload()
    {
        return view('fileupload.view_fileupload');
    }

    public function uploadExcel(Request $request)
    {
        ini_set('memory_limit', '1024M'); // Increase memory limit

        // Validate the incoming request data
        $request->validate([
            'file' => 'required|mimes:xlsx',
            'tipoArchivo' => 'required|in:mantenimiento,contratos,repuestos'
        ]);

        $tipoArchivo = $request->input('tipoArchivos');
        $file = $request->file('file');

        // Check if file was uploaded successfully
        if ($file->isValid()) {
            try {
                switch ($tipoArchivo) {
                    case 'mantenimiento':
                        Excel::import(new MaintReviewImport, $file);
                        break;
                    case 'contratos':
                        Excel::import(new ContractImport, $file);
                        break;
                    case 'repuestos':
                        Excel::import(new SparepartImport, $file);
                        break;
                    default:
                        return redirect()->back()->with('danger', 'Invalid file type selected.');
                }
                return redirect()->back()->with('success', 'Excel data imported successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('danger', 'Failed to import data: ' . $e->getMessage());
            }
        } else {
            return redirect()->back()->with('danger', 'Failed to upload Excel file.');
        }
    }

}
