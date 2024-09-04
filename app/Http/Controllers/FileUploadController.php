<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ContractImport;
use App\Imports\SparepartImport;
use App\Imports\MaintReviewImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class FileUploadController extends Controller
{
    public function fileupload()
    {
        return view('fileupload.view_fileupload');
    }

    public function uploadExcel(Request $request)
    {
        ini_set('memory_limit', '1024M');

        $request->validate([
            'file' => 'required|mimes:xlsx',
            'tipoArchivo' => 'required|in:mantenimiento,contratos,repuestos'
        ]);


        $tipoArchivo = $request->input('tipoArchivos');
        $file = $request->file('file');

        $expectedHeaders = [
            'mantenimiento' => ['tipo_de_revisión', 'ascensor', 'núm_certificado','fecha_de_mantenimiento','hora_inicio','hora_fin','técnico','observaciónes'],
            'contratos' => ['fecha_de_propuesta', 'monto_de_propuesta', 'fecha_de_inicio', 'fecha_de_fin','monto_de_contrato','estado'],
            'repuestos' => ['nombre', 'precio', 'frecuencia_de_limpieza', 'frecuencia_de_lubricación','frecuencia_de_ajuste','frecuencia_de_revisión','frecuencia_de_cambio','frecuencia_de_solicitud'],
        ];

        if ($file->isValid()) {
            try {

            $headers = Excel::toArray([], $file)[0][0];

            if ($this->validateHeaders($headers, $expectedHeaders[$tipoArchivo])) {
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
                        Log::info('Invalid file type selected');
                        return response()->json(['status' => 'danger', 'message' => 'Invalid file type selected.'], 400);
                }
                Log::info('Excel data imported successfully');
                return response()->json(['status' => 'success', 'message' => 'Excel data imported successfully.']);
            }
            else{
                Log::info('Excel file headers do not match expected headers');
                return response()->json(['status' => 'danger', 'message' => 'Excel file headers do not match expected headers.']);
            }
        }

            catch (\Exception $e) {
                Log::error('Failed to import data: ' . $e->getMessage());
                return response()->json(['status' => 'danger', 'message' => 'Failed to import data: ' . $e->getMessage()], 500);
            }
        } else {
            Log::warning('Failed to upload Excel file.');
            return response()->json(['status' => 'danger', 'message' => 'Failed to upload Excel file.'], 400);
        }
    }


    private function validateHeaders(array $actualHeaders, array $expectedHeaders): bool
    {
        // Sort both arrays to ensure the order is checked correctly
        sort($actualHeaders);
        sort($expectedHeaders);

        // Compare sorted arrays
        return $actualHeaders === $expectedHeaders;
    }






}
