<?php

namespace App\Http\Controllers;

use App\Models\Elevators;
use App\Models\ImagePdfs;
use App\Models\MaintInReview;
use App\Models\ReviewType;
use App\Models\Province;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\Supervisor;


class MaintInReviewController extends Controller
{
    public function maintInReview()
    {
        $maint_in_reviews = MaintInReview::all();
        $review_types = ReviewType::pluck('nombre', 'nombre');
        $elevators = Elevators::pluck('nombre', 'nombre');
        $provinces = Province::pluck('provincia', 'provincia');
        $Personals = Staff::pluck('nombre', 'nombre');

        return view('Maint.view_maint_in_review', compact('maint_in_reviews', 'review_types', 'elevators', 'provinces', 'Personals'));
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
            'supervisor' => $request->input('supervisor'),
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
            'supervisor' => $request->input('supervisor'),
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
        $maint_in_review = MaintInReview::findOrFail($id);
        $review_types = ReviewType::pluck('nombre', 'nombre');
        $elevators = Elevators::pluck('nombre', 'nombre');
        $spareparts = SparePart::all();
        $provinces = Province::pluck('provincia', 'provincia');
        $personals = Staff::pluck('nombre', 'nombre');
        $main_image = ImagePdfs::where('mant_en_revisións_id', $id)->where('document')->get();
        $documents = ImagePdfs::where('mant_en_revisións_id', $id)->where('image')->get();
        return view('Maint.view_maint_in_review_record', compact('spareparts', 'provinces', 'personals', 'maint_in_review', 'review_types', 'elevators', 'id', 'main_image', 'documents'));
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

        foreach ($request->file('files') as $file) {
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $uniqueName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;
            $destinationPath = public_path('documents');
            $file->move($destinationPath, $uniqueName);
            $document = ImagePdfs::create([
                'document' => $uniqueName,
                'mant_en_revisións_id' => $id
            ]);
            $documents[] = [
                'id' => $document->id,
                'filename' => $uniqueName,
            ];
        }

        return response()->json(['success' => true, 'documents' => $documents]);
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



