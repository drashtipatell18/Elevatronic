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

        $maint_in_reviews = MaintInReview::with(['staff', 'elevator', 'reviewtype'])
            ->when($searchValue, function ($query) use ($searchValue) {
                $searchValueLower = strtolower($searchValue); // Convert search value to lowercase
                return $query->where(function ($query) use ($searchValueLower) {
                    $query->whereRaw('LOWER(id) like ?', ["%{$searchValueLower}%"])
                        ->orWhereHas('reviewtype', function ($q) use ($searchValueLower) {
                            $q->whereRaw('LOWER(nombre) like ?', ["%{$searchValueLower}%"]);
                        });
                    // ->orWhereHas('elevator', function ($q) use ($searchValueLower) {
                    //     $q->whereRaw('LOWER(nombre) like ?', ["%{$searchValueLower}%"]);
                    // })
                    // ->orWhereRaw('LOWER(técnico) like ?', ["%{$searchValueLower}%"]);
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

        // Set title
        $sheet->mergeCells('A1:H1'); // Merge cells for the title
        $sheet->setCellValue('A1', 'Mantenimiento en Revisión');
        $sheet->getStyle('A1')->getFont()->setBold(true); // Make the title bold
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'ID');
        $sheet->setCellValue('B2', 'Tipo de Revisión');
        $sheet->setCellValue('C2', 'Tipo de Revisión');
        $sheet->setCellValue('D2', 'Ascensor');
        $sheet->setCellValue('E2', 'Fecha de Mantenimiento');
        $sheet->setCellValue('F2', 'HOR. INI');
        $sheet->setCellValue('G2', 'HOR. FIN');
        $sheet->setCellValue('H2', 'Técnico');

        // Populate data
        $row = 3; // Start from the third row due to the title and header
        foreach ($maint_in_reviews as $review) {
            $sheet->setCellValue('A' . $row, $review->id);
            $sheet->setCellValue('B' . $row, $review->reviewtype->nombre ?? '-');
            $sheet->setCellValue('C' . $row, $review->núm_certificado ?? '-');
            $sheet->setCellValue('D' . $row, $review->elevator->nombre ?? '-');
            $sheet->setCellValue('E' . $row, $review->fecha_de_mantenimiento);
            $sheet->setCellValue('F' . $row, $review->hora_inicio);
            $sheet->setCellValue('G' . $row, $review->hora_fin);
            $sheet->setCellValue('H' . $row, $review->staff->nombre ?? '-');
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

        $mpdf = new Mpdf(); // Create a new instance of mPDF
        $mpdf->SetDisplayMode('fullpage');

        // Check if there are any reviews to export
        if ($maint_in_reviews->isEmpty()) {
            $mpdf->WriteHTML('<h1>No data available for export</h1>');
            $mpdf->Output('no_data.pdf', 'D');
            exit;
        }

        $htmlHeader = '<h1 style="text-align: center;">Mantenimiento en Revisión</h1>';
        $htmlHeader .= '<table class="table table-striped" cellpadding="5" style="width: 100%; border-collapse: collapse;">';
        $htmlHeader .= '<tr style="background-color:#2D4054; color: white;">';
        $htmlHeader .= '<th class="text-center" style="color: white;">ID</th>';
        $htmlHeader .= '<th class="text-center" style="color: white;" >Tipo de Revisión</th>';
        $htmlHeader .= '<th class="text-center" style="color: white;" > Certificado</th>';
        $htmlHeader .= '<th class="text-center" style="color: white;" >Ascensor</th>';
        $htmlHeader .= '<th class="text-center" style="color: white;" >Fecha de Mantenimiento</th>';
        $htmlHeader .= '<th class="text-center" style="color: white;" >HOR. INI</th>';
        $htmlHeader .= '<th class="text-center" style="color: white;" >HOR. FIN</th>';
        $htmlHeader .= '<th class="text-center" style="color: white;" >Técnico</th>';
        $htmlHeader .= '</tr>';
        $mpdf->WriteHTML($htmlHeader); // Write header HTML

        // Process data in chunks
        $chunkSize = 1000; // Adjust chunk size as needed
        $totalReviews = $maint_in_reviews->count();

        for ($i = 0; $i < $totalReviews; $i += $chunkSize) {
            $chunk = $maint_in_reviews->slice($i, $chunkSize);
            $htmlChunk = '';

            foreach ($chunk as $review) {
                $htmlChunk .= '<tr>';
                $htmlChunk .= '<td style="text-align: center;">' . $review->id . '</td>'; // Centered
                $htmlChunk .= '<td style="text-align: center;">' . ($review->reviewtype->nombre ?? '-') . '</td>'; // Centered
                $htmlChunk .= '<td style="text-align: center;">' . ($review->núm_certificado ?? '-') . '</td>'; // Centered
                $htmlChunk .= '<td style="text-align: center;">' . ($review->elevator->nombre ?? '-') . '</td>'; // Centered
                $htmlChunk .= '<td style="text-align: center;">' . $review->fecha_de_mantenimiento . '</td>'; // Centered
                $htmlChunk .= '<td style="text-align: center;">' . $review->hora_inicio . '</td>'; // Centered
                $htmlChunk .= '<td style="text-align: center;">' . $review->hora_fin . '</td>'; // Centered
                $htmlChunk .= '<td style="text-align: center;">' . ($review->staff->nombre ?? '-') . '</td>'; // Centered
                $htmlChunk .= '</tr>';
            }

            $mpdf->WriteHTML($htmlChunk); // Write chunk HTML
        }

        $mpdf->WriteHTML('</table>'); // Close the table

        $filename = 'maint_in_review_' . date('Ymd') . '.pdf';
        $mpdf->Output($filename, 'D'); // 'D' for download
        exit; // Ensure no further output is sent
    }

    public function exportCopy($maint_in_reviews)
    {

        // Check if there are no reviews
        if ($maint_in_reviews->isEmpty()) {
            \Log::warning('No data available for export'); // Log warning if no data
            return response('No data available for export', 404)
                ->header('Content-Type', 'text/plain');
        }

        // Create a plain text representation of the data
        $output = "ID\tTipo de Revisión\tAscensor\tFecha de Mantenimiento\tTécnico\n";

        foreach ($maint_in_reviews as $review) {
            $output .= implode("\t", [
                $review->id,
                $review->reviewtype->nombre ?? '-',
                $review->núm_certificado ?? '-',
                $review->elevator->nombre ?? '-',
                $review->fecha_de_mantenimiento,
                $review->hora_inicio,
                $review->hora_fin,
                $review->staff->nombre ?? '-'
            ]) . "\n";
        }
        \Log::info('Export data prepared successfully'); // Log successful data preparation

        // Return the plain text response
        return response($output, 200)
            ->header('Content-Type', 'text/plain'); // Ensure the content type is plain text
    }

    private function exportPrint()
    {
        // Number of records to process per chunk (adjust as necessary for your server)
        $chunkSize = 1000;

        // Count total records and divide into chunks
        $totalRecords = MaintInReview::count();
        $totalChunks = ceil($totalRecords / $chunkSize);

        $html = ''; // Initialize HTML variable to accumulate results

        for ($i = 0; $i < $totalChunks; $i++) {
            $html .= $this->generateHtmlChunk($i * $chunkSize, $chunkSize); // Append each chunk's HTML
        }

        return view('Maint.print', [
            'html' => $html,
            'totalChunks' => $totalChunks,
            'chunkSize' => $chunkSize
        ]);
    }

    private function generateHtmlChunk($offset, $chunkSize)
    {
        $html = '';
        $html .= '<table cellpadding="5"><tr><th>ID</th><th>Tipo de Revisión</th><th>Certificado</th><th>Ascensor</th><th>Fecha de Mantenimiento</th><th>HOR. INI</th><th>HOR. FIN</th><th>Técnico</th></tr>';

        // Fetch a chunk of data from the database
        $reviews = MaintInReview::with(['reviewtype', 'elevator', 'staff'])
            ->offset($offset)
            ->limit($chunkSize)
            ->get();

        foreach ($reviews as $review) {
            $html .= '<tr>';
            $html .= '<td>' . $review->id . '</td>';
            $html .= '<td>' . ($review->reviewtype->nombre ?? '-') . '</td>';
            $html .= '<td>' . ($review->núm_certificado ?? '-') . '</td>';
            $html .= '<td>' . ($review->elevator->nombre ?? '-') . '</td>';
            $html .= '<td>' . $review->fecha_de_mantenimiento . '</td>';
            $html .= '<td>' . $review->hora_inicio . '</td>';
            $html .= '<td>' . $review->hora_fin . '</td>';
            $html .= '<td>' . ($review->staff->nombre ?? '-') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        return $html;
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
                $destinationPath = ('documents');

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
        $imagePath = ('images/' . $image->image);
        $image->delete();
        return response()->json(['success' => true]);
    }
}
