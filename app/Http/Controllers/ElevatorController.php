<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elevators;
use App\Models\Cliente;
use App\Models\Province;
use App\Models\SparePart;
use App\Models\Marca;
use App\Models\Contract;
use App\Models\MaintInReview;
use App\Models\ReviewType;
use App\Models\Elevatortypes\Elevatortypes;
use App\Models\Staff;
use App\Models\Schedule;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ElevatorController extends Controller
{
    public function elevator(Request $request) // Added Request parameter
    {
        $elevators = Elevators::with(['client', 'tecnicoAjustador', 'tecnicoInstalador', 'province', 'tipoDeAscensor'])->get();
        $customers = Cliente::pluck('nombre', 'id');
        $allCustomers = Cliente::all();
        $provinces = Province::pluck('provincia', 'id');
        $elevatortypes = Elevatortypes::pluck('nombre_de_tipo_de_ascensor', 'id');
        $staffs = Staff::pluck('nombre', 'id');

        return view('elevator.view_elevator', compact('elevators', 'allCustomers', 'customers', 'provinces', 'elevatortypes', 'staffs'));
    }

    public function elevatorApi(Request $request) // Added Request parameter
    {
        $elevators = Elevators::with(['client', 'tecnicoAjustador', 'tecnicoInstalador', 'province', 'tipoDeAscensor'])->get();
        $customers = Cliente::pluck('nombre', 'id');
        $allCustomers = Cliente::all();
        $provinces = Province::pluck('provincia', 'id');
        $elevatortypes = Elevatortypes::pluck('nombre_de_tipo_de_ascensor', 'id');
        $staffs = Staff::pluck('nombre', 'id');

        return response()->json(compact('elevators', 'allCustomers', 'customers', 'provinces', 'elevatortypes', 'staffs'));
    }


    public function getBrands()
    {
        return response()->json(Marca::all());
    }

    public function getData()
    {
        // Return all data in a single response array
        return response()->json([
            'clientes' => Cliente::pluck('nombre', 'id')->toArray(), // Convert to array
            'provincias' => Province::pluck('provincia', 'id')->toArray(), // Convert to array
            'elevatortypes' => Elevatortypes::pluck('nombre_de_tipo_de_ascensor', 'id')->toArray(), // Convert to array
            'staffs' => Staff::pluck('nombre', 'id')->toArray(), // Convert to array
        ]);
    }
    public function insertBrand(Request $request)
    {
        Marca::create([
            'marca_nombre' => $request->input('marca_nombre'),
        ]);

        return response()->json(['success' => 'Brand added successfully!']);
    }
    public function getElevators(Request $request)
    {
        $province = $request->input('province'); // Get the province from the request
        // Fetch elevators based on the selected province
        $elevators = Elevators::where('provincia', $province)->get()->toArray();

        return response()->json($elevators); // Return the elevators as a JSON response
    }
    public function elevatorInsert(Request $request)
    {
        $filename = '';
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }

        if (is_array($request->input('quarters'))) {
            $quarters = implode(',', $request->input('quarters'));
        } else {
            $quarters = $request->input('quarters');
        }

        // Create a new Elevators instance
        $elevators = Elevators::create([
            'imagen'              => $filename,
            'contrato'            => $request->input('contrato'),
            'nombre'              => $request->input('nombre'),
            'código'              => $request->input('código'),
            'marca_id'            => $request->input('marca_id'),
            'client_id'           => $request->input('client_id'),
            'fecha'               => $request->input('fecha'),
            'garantizar'          => $request->input('garantizar'),
            'dirección'           => $request->input('dirección'),
            'ubigeo'              => $request->input('ubigeo'),
            'provincia'           => $request->input('provincia'),
            'técnico_instalador'  => $request->input('técnico_instalador'),
            'técnico_ajustador'   => $request->input('técnico_ajustador'),
            'tipo_de_ascensor'    => $request->input('tipo_de_ascensor'),
            'cantidad'            => $request->input('cantidad'),
            'quarters'            => $quarters,
            'npisos'              => $request->input('npisos'),
            'ncontacto'           => $request->input('ncontacto'),
            'teléfono'            => $request->input('teléfono'),
            'correo'              => $request->input('correo'),
            'descripcion1'        => $request->input('descripcion1'),
            'descripcion2'        => $request->input('descripcion2'),
        ]);


        // Redirect back with success message
        session()->flash('success', 'Ascensores creado exitosamente!');
        return redirect()->route('elevator');
    }

    public function maintInReviewInsertelevator(Request $request, $id)
    {
        // dd($request->all());
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'tipo_de_revisión' => 'required',
                'técnico' => 'required',
                'fecha_de_mantenimiento' => 'required|date',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'núm_certificado' => 'required',
            ]);

            // Fetch the elevator data
            $elevator = Elevators::findOrFail($id);

            // Create a new MaintInReview instance
            $maintinreview = MaintInReview::create([
                'tipo_de_revisión' => $request->input('tipo_de_revisión'),
                'ascensor' => $elevator->id,
                'dirección' => $elevator->dirección,
                'provincia' => $request->input('provincia'),
                'núm_certificado' => $request->input('núm_certificado'),
                'supervisor_id' => $request->input('supervisor_id'),
                'técnico' => $request->input('técnico'),
                'mes_programado' => $request->input('mes_programado'),
                'fecha_de_mantenimiento' => $request->input('fecha_de_mantenimiento'),
                'hora_inicio' => $request->input('hora_inicio'),
                'hora_fin' => $request->input('hora_fin'),
                'observaciónes' => $request->input('observaciónes') ?? null,
                'observaciónes_internas' => $request->input('observaciónes_internas') ?? null,
                'solución' => $request->input('solución'),
            ]);

            // Redirect back with success message
            return redirect()->route('ascensore')->with('success', 'Mant En Revisión creado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear Mant En Revisión: ' . $e->getMessage())->withInput();
        }
    }

    public function elevatorEdit($id)
    {
        $elevator = Elevators::findOrFail($id);
        $allCustomers = Cliente::all();
        return view('elevator.view_elevator', compact('elevator'));
    }


    public function elevatorUpdate(Request $request, $id)
    {
        // dd($request->all());
        $elevator = Elevators::findOrFail($id);

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);

            // Update the imagen attribute with the new filename
            $elevator->imagen = $filename;
        }
        if (is_array($request->input('quarters'))) {
            $quarters = implode(',', $request->input('quarters'));
        } else {
            $quarters = $request->input('quarters');
        }
        $oldElevatorName = $elevator->nombre;
        // dd($quarters);

        //  update Elevators instance
        $elevator->update([
            'contrato'            => $request->input('contrato'),
            'nombre'              => $request->input('nombre'),
            'código'              => $request->input('código'),
            'marca_id'            => $request->input('marca_id'),
            'client_id'           => $request->input('client_id'),
            'fecha'               => $request->input('fecha'),
            'garantizar'          => $request->input('garantizar'),
            'dirección'           => $request->input('dirección'),
            'ubigeo'              => $request->input('ubigeo'),
            'provincia'           => $request->input('provincia'),
            'técnico_instalador'  => $request->input('técnico_instalador'),
            'técnico_ajustador'   => $request->input('técnico_ajustador'),
            'tipo_de_ascensor'    => $request->input('tipo_de_ascensor'),
            'cantidad'            => $request->input('cantidad'),
            'quarters'            => $quarters,
            'npisos'              => $request->input('npisos'),
            'ncontacto'           => $request->input('ncontacto'),
            'teléfono'            => $request->input('teléfono'),
            'correo'              => $request->input('correo'),
            'descripcion1'        => $request->input('descripcion1'),
            'descripcion2'        => $request->input('descripcion2'),
        ]);
        Contract::where('ascensor', $oldElevatorName)
            ->update(['ascensor' => $request->input('nombre')]);
        MaintInReview::where('ascensor', $oldElevatorName)
            ->update(['ascensor' => $request->input('nombre')]);
        Schedule::where('ascensor', $oldElevatorName)
            ->update(['ascensor' => $request->input('nombre')]);
        // Redirect back with success message
        session()->flash('success', 'Ascensores actualizado exitosamente!');
        return redirect()->route('elevator');
    }

    public function elevatorView(Request $request, $id)
    {
        $elevators = Elevators::with(['client', 'tecnicoAjustador', 'tecnicoInstalador', 'province', 'tipoDeAscensor', 'marca'])->find($id);
        $contracts = Contract::where('ascensor', $elevators->id)->get();
        $spareparts = SparePart::all();
        $customers = Cliente::pluck('nombre', 'id');
        $provinces = Province::pluck('provincia', 'id');
        $maint_in_reviews = MaintInReview::with('reviewtype')->where('ascensor', $elevators->id)->get();
        $elevatornumber = Elevators::pluck('nombre', 'nombre');
        $review_types  = ReviewType::pluck('nombre', 'id');
        $elevatortypes = Elevatortypes::pluck('nombre_de_tipo_de_ascensor', 'id');
        $staffs = Staff::pluck('nombre', 'id');
        return view('elevator.view_elevator_details', compact('elevatortypes', 'staffs', 'elevators', 'elevatornumber', 'review_types', 'maint_in_reviews', 'spareparts', 'customers', 'provinces', 'contracts'));
    }
    public function Elevatorexport($type,$id)
    {
        $maint_in_reviews = MaintInReview::with('reviewtype')->where('ascensor', $id)->get();

        switch ($type) {
            case 'excel':
                return $this->exportExcel($maint_in_reviews);
            case 'pdf':
                return $this->exportPdf($maint_in_reviews);
            case 'copy':
                return $this->exportCopy($maint_in_reviews);
            case 'print':
                return $this->exportPrint($id);
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
        $sheet->setCellValue('C2', 'Certificado');
        $sheet->setCellValue('D2', 'Ascensor');
        $sheet->setCellValue('E2', 'Fecha de Mantenimiento');
        $sheet->setCellValue('F2', 'HOR. INI');
        $sheet->setCellValue('G2', 'HOR. FIN');
        $sheet->setCellValue('H2', 'Técnico');
        $sheet->setCellValue('H2', 'OBSERVACIÓN');

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
            $sheet->setCellValue('H' . $row, $review->observaciónes ?? '-');
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
        $htmlHeader .= '<th class="text-center" style="color: white;" >OBSERVACIÓN</th>';
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
                $htmlChunk .= '<td style="text-align: center;">' . ($review->observaciónes ?? '-') . '</td>'; // Centered
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
        $output = "ID\tTipo de Revisión\tAscensor\tFecha de Mantenimiento\tTécnico\tObservaciónes\n";

        foreach ($maint_in_reviews as $review) {
            $output .= implode("\t", [
                $review->id,
                $review->reviewtype->nombre ?? '-',
                $review->núm_certificado ?? '-',
                $review->elevator->nombre ?? '-',
                $review->fecha_de_mantenimiento,
                $review->hora_inicio,
                $review->hora_fin,
                $review->staff->nombre ?? '-',
                $review->observaciónes
            ]) . "\n";
        }
        \Log::info('Export data prepared successfully'); // Log successful data preparation

        // Return the plain text response
        return response($output, 200)
            ->header('Content-Type', 'text/plain'); // Ensure the content type is plain text
    }

    private function exportPrint($id)
    {

        // Number of records to process per chunk (adjust as necessary for your server)
        $chunkSize = 1000;

        // Count total records and divide into chunks
        $totalRecords = MaintInReview::where('ascensor', $id)->count(); // Ensure filtering by ID

        $totalChunks = ceil($totalRecords / $chunkSize);

        $html = ''; // Initialize HTML variable to accumulate results

        for ($i = 0; $i < $totalChunks; $i++) {
            $html .= $this->generateHtmlChunk($i * $chunkSize, $chunkSize, $id); // Append each chunk's HTML
        }

        // Log the generated HTML for debugging
        \Log::info('Generated HTML: ' . $html);

        return view('elevator.print', [
            'html' => $html,
            'totalChunks' => $totalChunks,
            'chunkSize' => $chunkSize
        ]);
    }

    private function generateHtmlChunk($offset, $chunkSize,$id)
    {
        $html = '';
        $html .= '<table cellpadding="5"><tr><th>ID</th><th>Tipo de Revisión</th><th>Certificado</th><th>Ascensor</th><th>Fecha de Mantenimiento</th><th>HOR. INI</th><th>HOR. FIN</th><th>Técnico</th><th>OBSERVACIÓN</th></tr>';

        // Fetch a chunk of data from the database
            $reviews = MaintInReview::with('reviewtype')->where('ascensor', $id)->offset($offset)
            ->limit($chunkSize)->get();

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
            $html .= '<td>' . ($review->observaciónes ?? '-') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        return $html;
    }
    public function contractInsert(Request $request)
    {
        $validatedData = $request->validate([
            'ascensor' => 'required',
            'fecha_de_propuesta' => 'required',
            'monto_de_propuesta' => 'required',
            'monto_de_contrato' => 'required',
            'fecha_de_inicio' => 'required',
            'fecha_de_fin' => 'required',
            'cada_cuantos_meses' => 'required',
            'observación' => 'required',
            'estado_cuenta_del_contrato' => 'required',
            'estado' => 'required',
        ]);

        // Create a new Contract instance
        $contract = Contract::create([
            'ascensor'                   => $request->input('ascensor'),
            'fecha_de_propuesta'         => $request->input('fecha_de_propuesta'),
            'monto_de_propuesta'         => $request->input('monto_de_propuesta'),
            'monto_de_contrato'          => $request->input('monto_de_contrato'),
            'fecha_de_inicio'            => $request->input('fecha_de_inicio'),
            'fecha_de_fin'               => $request->input('fecha_de_fin'),
            'renovación'                 => $request->input('renovación'),
            'cada_cuantos_meses'         => $request->input('cada_cuantos_meses'),
            'observación'                => $request->input('observación'),
            'estado_cuenta_del_contrato' => $request->input('estado_cuenta_del_contrato'),
            'estado'                     => strtolower($request->input('estado')),
        ]);

        // Redirect back with success message
        return redirect()->route('elevator')->with('success', 'Contrato creado exitosamente!');
    }

    public function contractUpdate(Request $request, $id)
    {
        // dd($request->all);
        $validatedData = $request->validate([
            'ascensor' => 'required',
            'fecha_de_propuesta' => 'required',
            'monto_de_propuesta' => 'required',
            'monto_de_contrato' => 'required',
            'fecha_de_inicio' => 'required',
            'fecha_de_fin' => 'required',
            'cada_cuantos_meses' => 'required',
            'observación' => 'required',
            'estado_cuenta_del_contrato' => 'required',
            'estado' => 'required',
        ]);

        $contract = Contract::find($id); // Change to find() for debugging
        // Create a new Contract instance
        $contract->update([
            'ascensor'              => $request->input('ascensor'),
            'fecha_de_propuesta'     => $request->input('fecha_de_propuesta'),
            'monto_de_propuesta'       => $request->input('monto_de_propuesta'),
            'monto_de_contrato'        => $request->input('monto_de_contrato'),
            'fecha_de_inicio'          => $request->input('fecha_de_inicio'),
            'fecha_de_fin'           => $request->input('fecha_de_fin'),
            'renovación'            => $request->input('renovación'),
            'cada_cuantos_meses'      => $request->input('cada_cuantos_meses'),
            'observación'           => $request->input('observación'),
            'estado_cuenta_del_contrato' => $request->input('estado_cuenta_del_contrato'),
            'estado'            => strtolower($request->input('estado')),
        ]);

        // session()->flash('success', 'Contract actualizado exitosamente!');
        // return redirect()->route('ascensore');
        return redirect()->route('elevator')->with('success', 'Contrato actualizado exitosamente!');
    }

    public function contractDestroy($id)
    {
        $contract = Contract::find($id);
        $contract->delete();
        session()->flash('danger', 'Contrato eliminado exitosamente!');
        return redirect()->back();
    }


    public function elevatorDestroy($id)
    {
        $elevator = Elevators::find($id);
        $elevator->delete();
        session()->flash('danger', 'Ascensores eliminar exitosamente!');
        return redirect()->route('elevator');
    }

    public function getContract($id)
    {
        $contracts = Contract::find($id);
        return response()->json($contracts);
    }
}
