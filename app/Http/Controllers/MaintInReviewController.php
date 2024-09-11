<?php

namespace App\Http\Controllers;

use App\Models\Elevators;
use App\Models\ImagePdfs;
use App\Models\ReviewType;
use App\Models\Province;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\Month;
use App\Models\Supervisor;
use App\Models\MaintInReview;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MaintInReviewController extends Controller
{
    public function maintInReview(Request $request)
    {
        $maint_in_reviews = MaintInReview::with(['staff', 'elevator', 'reviewtype'])->get();
        $review_types = ReviewType::pluck('nombre', 'id');
        $elevators = Elevators::pluck('nombre', 'id');
        $provinces = Province::pluck('provincia', 'id');
        $Personals = Staff::pluck('nombre', 'id');
        $months = Month::pluck('nombre', 'id');
        return view('Maint.view_maint_in_review', compact('months', 'maint_in_reviews', 'review_types', 'elevators', 'provinces', 'Personals'));
    }
    public function maintInReviewApi(Request $request)
    {
        // Get the start and length parameters from DataTables
        $start = $request->input('start', 0);  // Starting record (offset)
        $length = $request->input('length', 20);  // Number of records per page

        // Calculate the current page
        $currentPage = ($start / $length) + 1;
        // Get the sorting parameters
        $sortColumn = $request->input('order.0.column', 'id'); // Default sort column
        $sortDirection = $request->input('order.0.dir', 'asc'); // Default sort direction

        // Validate sort direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc'; // Fallback to default
        }

        // Define allowed columns for sorting
        $allowedSortColumns = ['id', 'tipo_de_revisión', 'ascensor', 'provincia']; // Add other columns as needed

        // Validate sort column
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'id'; // Fallback to default
        }
        $searchValue = $request->input('search.value', ''); // Default to empty string

        // Fetch paginated data with sorting
        $maint_in_reviews = MaintInReview::with(['staff', 'elevator', 'reviewtype'])
            ->when($searchValue, function ($query) use ($searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->where('id', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy($sortColumn, $sortDirection) // Add sorting
            ->paginate($length, ['*'], 'page', $currentPage);
        // Send the paginated response
        return response()->json([
            'draw' => $request->input('draw'),  // Pass the 'draw' parameter from DataTables
            'recordsTotal' => $maint_in_reviews->total(),  // Total number of records
            'recordsFiltered' => $maint_in_reviews->total(),  // Total number of filtered records
            'data' => $maint_in_reviews->items(),  // Data for the current page
        ]);
    }

    public function export($type)
    {
        $maint_in_reviews = MaintInReview::with(['staff', 'elevator', 'reviewtype'])->get();

        switch ($type) {
            case 'excel':
                return $this->exportExcel($maint_in_reviews);
            case 'pdf':
                return $this->exportPdf($maint_in_reviews);
            case 'copy':
                return $this->exportCopy($maint_in_reviews);
            case 'print':
                return $this->exportPrint($maint_in_reviews);
            default:
                return redirect()->back()->with('error', 'Invalid export type');
        }
    }

    private function exportExcel($maint_in_reviews)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tipo de Revisión');
        $sheet->setCellValue('C1', 'Ascensor');
        $sheet->setCellValue('D1', 'Fecha de Mantenimiento');
        $sheet->setCellValue('E1', 'Técnico');

        // Populate data
        $row = 2; // Start from the second row
        foreach ($maint_in_reviews as $review) {
            $sheet->setCellValue('A' . $row, $review->id);
            $sheet->setCellValue('B' . $row, $review->reviewtype->nombre ?? '-'); // Use 'N/A' if reviewtype is null            $sheet->setCellValue('C' . $row, $review->elevator->nombre);
            $sheet->setCellValue('D' . $row, $review->fecha_de_mantenimiento);
            $sheet->setCellValue('E' . $row, $review->staff->nombre ?? '-');
            $row++;
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'maint_in_review_' . date('Ymd') . '.xlsx';

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }

    private function exportPdf($maint_in_reviews)
    {
        $mpdf = new \Mpdf\Mpdf(); // Create a new instance of mPDF
        $html = '<h1>Mantenimiento en Revisión</h1>';
        $html .= '<table cellpadding="5"><tr><th>ID</th><th>Tipo de Revisión</th><th>Ascensor</th><th>Fecha de Mantenimiento</th><th>Técnico</th></tr>';
    
        foreach ($maint_in_reviews as $review) {
            $html .= '<tr>';
            $html .= '<td>' . $review->id . '</td>';
            $html .= '<td>' . ($review->reviewtype->nombre ?? '-') . '</td>'; // Use '-' if reviewtype is null
            $html .= '<td>' . $review->elevator->nombre . '</td>';
            $html .= '<td>' . $review->fecha_de_mantenimiento . '</td>';
            $html .= '<td>' . ($review->staff->nombre ?? '-') . '</td>';
            $html .= '</tr>';
        }
    
        $html .= '</table>';
        $filename = 'maint_in_review_' . date('Ymd') . '.pdf';
        
        $mpdf->WriteHTML($html); // Write the HTML to the PDF
        $mpdf->Output($filename, 'D'); // 'D' for download
        exit; // Ensure no further output is sent
    }

    private function exportCopy($maint_in_reviews)
    {
        // Logic for copying data to clipboard
        // This typically requires client-side handling
        // You can return a JSON response or handle it in the frontend
        return response()->json(['data' => $maint_in_reviews]);
    }

    private function exportPrint($maint_in_reviews)
    {
        $html = '<h1>Mantenimiento en Revisión</h1>';
        $html .= '<table cellpadding="5"><tr><th>ID</th><th>Tipo de Revisión</th><th>Ascensor</th><th>Fecha de Mantenimiento</th><th>Técnico</th></tr>';
    
        foreach ($maint_in_reviews as $review) {
            $html .= '<tr>';
            $html .= '<td>' . $review->id . '</td>';
            $html .= '<td>' . ($review->reviewtype->nombre ?? '-') . '</td>'; // Use '-' if reviewtype is null
            $html .= '<td>' . ($review->elevator->nombre ?? '-') .'</td>';
            $html .= '<td>' . $review->fecha_de_mantenimiento . '</td>';
            $html .= '<td>' . ($review->staff->nombre ?? '-') . '</td>';
            $html .= '</tr>';
        }
    
        $html .= '</table>';
        
        // Return the HTML for printing
        return response($html)->header('Content-Type', 'text/html');
    }
    public function getDataMaintance()
    {
        return response()->json([
            'months' =>   Month::pluck('nombre', 'id')->toArray(), // Fetch all data with eager loading
            'review_types' => ReviewType::pluck('nombre', 'id')->toArray(), // Convert to array
            'elevators' => Elevators::pluck('nombre', 'id')->toArray(), // Convert to array
            'provinces' => Province::pluck('provincia', 'id')->toArray(),
            'staffs' => Staff::pluck('nombre', 'id')->toArray(), // Convert to array
        ]);
    }
    public function totalRecordCount()
    {
        $maint_in_reviews = MaintInReview::all();
        $totalRecordCount = $maint_in_reviews->count();
        return view('layouts.main', compact('totalRecordCount'));
    }

    public function insertSupervisor(Request $request)
    {
        $supervisor = Supervisor::create([
            'nomber' => $request->input('nomber'),
        ]);

        return response()->json(['success' => 'Supervisor added successfully!', 'supervisor' => $supervisor]);
    }

    public function getSupervisors()
    {
        return response()->json(Supervisor::all());
    }

    public function getObservation($id)
    {
        $observation = MaintInReview::find($id); // Adjust this line based on your model

        if (!$observation) {
            return response()->json(['message' => 'Observation not found'], 404);
        }

        return response()->json($observation); // Ensure this returns an object with 'observaciones' property
    }
    public function maintInReviewInsert(Request $request)
    {
        $request->validate([
            'tipo_de_revisión' => 'required',
            'ascensor' => 'required',
            'dirección' => 'required',
            'provincia' => 'required',
            'núm_certificado' => 'required',
            // 'máquina' => 'required',
            // 'supervisor' => 'required',
            'técnico' => 'required',
            // 'mes_programado' => 'required',
            'fecha_de_mantenimiento' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        // Create a new Province instance
        $maintinreview = MaintInReview::create([
            'tipo_de_revisión' => $request->input('tipo_de_revisión'),
            'ascensor' => $request->input('ascensor'),
            'dirección' => $request->input('dirección'),
            'provincia' => $request->input('provincia'),
            'núm_certificado' => $request->input('núm_certificado'),
            // 'máquina' => $request->input('máquina'),
            'supervisor_id' => $request->input('supervisor_id'),
            'técnico' => $request->input('técnico'),
            'mes_programado' => $request->input('mes_programado'),
            'fecha_de_mantenimiento' => $request->input('fecha_de_mantenimiento'),
            'hora_inicio' => $request->input('hora_inicio'),
            'hora_fin' => $request->input('hora_fin'),
            'observaciónes' => $request->input('observaciónes'),
            'observaciónes_internas' => $request->input('observaciónes_internas'),
            'solución' => $request->input('solución'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Mant En Revisión creado exitosamente!');
        return redirect()->route('maint_in_review');
    }

    public function maintInReviewUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tipo_de_revisión' => 'required',
            'ascensor' => 'required',
            'dirección' => 'required',
            'provincia' => 'required',
            'núm_certificado' => 'required',
            // 'máquina' => 'required',
            // 'supervisor' => 'required',
            'técnico' => 'required',
            // 'mes_programado' => 'required',
            'fecha_de_mantenimiento' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);
        $maint_in_review = MaintInReview::findOrFail($id);

        // Create a new Province instance
        $maint_in_review->update([
            'tipo_de_revisión' => $request->input('tipo_de_revisión'),
            'ascensor' => $request->input('ascensor'),
            'dirección' => $request->input('dirección'),
            'provincia' => $request->input('provincia'),
            'núm_certificado' => $request->input('núm_certificado'),
            // 'máquina' => $request->input('máquina'),
            'supervisor_id' => $request->input('supervisor_id'),
            'técnico' => $request->input('técnico'),
            'mes_programado' => $request->input('mes_programado'),
            'fecha_de_mantenimiento' => $request->input('fecha_de_mantenimiento'),
            'hora_inicio' => $request->input('hora_inicio'),
            'hora_fin' => $request->input('hora_fin'),
            'observaciónes' => $request->input('observaciónes'),
            'observaciónes_internas' => $request->input('observaciónes_internas'),
            'solución' => $request->input('solución'),
        ]);

        session()->flash('success', 'Mant En Revisión actualizado exitosamente!');
        return redirect()->route('maint_in_review');
    }
    public function maintInReviewDestroy($id)
    {
        $maint_in_review = MaintInReview::find($id);
        $maint_in_review->delete();
        session()->flash('danger', 'Mant En Revisión eliminar exitosamente!');
        return redirect()->route('maint_in_review');
    }

    public function maintInReviewDetails($id)
    {
        $maint_in_review = MaintInReview::with(['supervisor', 'staff', 'elevator', 'reviewtype', 'month', 'province'])->findOrFail($id);
        $review_types = ReviewType::pluck('nombre', 'id');
        $elevators = Elevators::pluck('nombre', 'id');
        $spareparts = SparePart::all();
        $provinces = Province::pluck('provincia', 'id');
        $Personals = Staff::pluck('nombre', 'id');
        $months = Month::pluck('nombre', 'id');
        $main_image = ImagePdfs::where('mant_en_revisións_id', $id)->where('document')->get();
        $documents = ImagePdfs::where('mant_en_revisións_id', $id)->where('image')->get();
        return view('Maint.view_maint_in_review_record', compact('spareparts', 'provinces', 'Personals', 'months', 'maint_in_review', 'review_types', 'elevators', 'id', 'main_image', 'documents'));
    }


    public function saveImage(Request $request, $id)
    {
        $savedImages = [];

        foreach ($request->image as $image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);

            $savedImage = ImagePdfs::create([
                'image' => $filename,
                'mant_en_revisións_id' => $request->id
            ]);

            $savedImages[] = [
                'id' => $savedImage->id,
                'filename' => $filename,
            ];
        }

        return response()->json($savedImages);
    }

    public function saveDocument(Request $request, $id)
    {
        $documents = [];
        $successful = true;

        try {
            foreach ($request->file('files') as $index => $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uniqueName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;
                $destinationPath = public_path('documents');

                if (!$file->move($destinationPath, $uniqueName)) {
                    throw new \Exception("Failed to move file {$index}: {$originalName}");
                }

                $document = ImagePdfs::create([
                    'document' => $uniqueName,
                    'original_name' => $originalName, // Store the original name if needed
                    'mant_en_revisións_id' => $id
                ]);

                $documents[] = [
                    'id' => $document->id,
                    'filename' => $uniqueName,
                    'original_name' => $originalName // Include the original name in the response
                ];
            }
        } catch (\Exception $e) {
            $successful = false;
            return response()->json(['success' => $successful, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => $successful, 'documents' => $documents]);
    }


    public function deleteDocument($imageId)
    {
        $image = ImagePdfs::find($imageId);

        if ($image) {
            $image->delete();
        }
        return response()->json(['success' => true]);
    }

    public function deleteImage(Request $request, $imageId)
    {
        $image = ImagePdfs::findOrFail($imageId);
        $imagePath = public_path('images/' . $image->image);
        $image->delete();
        return response()->json(['success' => true]);
    }
}
