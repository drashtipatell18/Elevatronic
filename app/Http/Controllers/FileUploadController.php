<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MaintReviewImport;
use App\Imports\ContractImport;
use App\Imports\SparepartImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Validation\Rules\Exists;

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
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls',
            'tipoArchivo' => 'required|in:mantenimiento,contratos,repuestos',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $tipoArchivo = $request->input('tipoArchivos');
        $file = $request->file('file');


        $requiredMantenimientoHeadings = ['tipo_de_revisión', 'ascensor', 'núm_certificado','fecha_de_mantenimiento', 'hora_inicio', 'hora_fin','técnico','observaciónes'];

        // $requiredContratosHeadings = ['fecha_de_propuesta','monto_de_propuesta','fecha_de_inicio','fecha_de_fin','monto_de_contrato','estado'];
        // $requiredRepuestosHeadings = ['nombre','precio','frecuencia_de_limpieza','frecuencia_de_lubricación','frecuencia_de_ajuste','frecuencia_de_revisión','frecuencia_de_cambio','frecuencia_de_solicitud'];


        // Check if file was uploaded successfully



        // if ($file->isValid()) {
            try {
                switch ($tipoArchivo) {
                    case 'mantenimiento':
                        $headings = (new HeadingRowImport)->toArray($file);


                        if (empty($headings) || !$this->validateHeadings($headings[0][0], $requiredMantenimientoHeadings)) {
                            return redirect()->back()->with('error', 'The uploaded file does not have the required headings for mantenimiento.');
                        }

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
            } catch (\Exception $e) {
                return redirect()->back()->with('danger', 'Failed to import data: ' . $e->getMessage());
            }
             return redirect()->back()->with('success', 'Excel data imported successfully.');
        // } else {
        //     return redirect()->back()->with('danger', 'Failed to upload Excel file.');
        // }
    }

    private function validateHeadings(array $fileHeadings, array $requiredMantenimientoHeadings)
    {
        foreach ($requiredMantenimientoHeadings as $heading) {
            if (!in_array($heading, $fileHeadings)) {
                return false;
            }
        }
        return true;
    }






}

