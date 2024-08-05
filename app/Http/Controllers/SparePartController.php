<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;

class SparePartController extends Controller
{
    public function sparepart()
    {
        $spareparts = SparePart::all();
        return view('sparepart.view_sparepart', compact('spareparts'));
    }

    public function sparepartInsert(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            // 'descripción' => 'required',
            // 'frecuencia_de_limpieza' => 'required',
            // 'frecuencia_de_lubricación' => 'required',
            // 'frecuencia_de_ajuste' => 'required',
            // 'frecuencia_de_revisión' => 'required',
            // 'frecuencia_de_cambio' => 'required',
            // 'frecuencia_de_solicitud' => 'required',
        ]);


        $filename = '';
        if ($request->hasFile('foto_de_repuesto')) {
            $image = $request->file('foto_de_repuesto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }

        $sparepart = SparePart::create([
            'foto_de_repuesto'           => $filename,
            'nombre'                     => $request->input('nombre'),
            'precio'                     => $request->input('precio'),
            'descripción'                => $request->input('descripción'),
            'frecuencia_de_limpieza'     => $request->input('frecuencia_de_limpieza'),
            'frecuencia_de_lubricación'  => $request->input('frecuencia_de_lubricación'),
            'frecuencia_de_ajuste'       => $request->input('frecuencia_de_ajuste'),
            'frecuencia_de_revisión'     => $request->input('frecuencia_de_revisión'),
            'frecuencia_de_cambio'       => $request->input('frecuencia_de_cambio'),
            'frecuencia_de_solicitud'    => $request->input('frecuencia_de_solicitud'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Piezas de repuesto creado exitosamente!');
        return redirect()->route('sparepart');
    }

    public function sparepartUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            // 'descripción' => 'required',
            // 'frecuencia_de_limpieza' => 'required',
            // 'frecuencia_de_lubricación' => 'required',
            // 'frecuencia_de_ajuste' => 'required',
            // 'frecuencia_de_revisión' => 'required',
            // 'frecuencia_de_cambio' => 'required',
            // 'frecuencia_de_solicitud' => 'required',
        ]);

        $sparepart = SparePart::findOrFail($id);

        if ($request->hasFile('foto_de_repuesto')) {
            $image = $request->file('foto_de_repuesto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);

            // Update the imagen attribute with the new filename
            $sparepart->foto_de_repuesto = $filename;
        }

        $sparepart->update([
            'nombre'                     => $request->input('nombre'),
            'precio'                     => $request->input('precio'),
            'descripción'                => $request->input('descripción'),
            'frecuencia_de_limpieza'     => $request->input('frecuencia_de_limpieza'),
            'frecuencia_de_lubricación'  => $request->input('frecuencia_de_lubricación'),
            'frecuencia_de_ajuste'       => $request->input('frecuencia_de_ajuste'),
            'frecuencia_de_revisión'     => $request->input('frecuencia_de_revisión'),
            'frecuencia_de_cambio'       => $request->input('frecuencia_de_cambio'),
            'frecuencia_de_solicitud'    => $request->input('frecuencia_de_solicitud'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Piezas de repuesto actualizado exitosamente!');
        return redirect()->route('sparepart');
    }


    public function sparepartView($id)
    {
        $sparepart = SparePart::find($id);
        return view('sparepart.view_sparepart_record', compact('sparepart'));
    }

    public function sparepartDestroy($id)
    {
        $sparepart = SparePart::find($id);
        $sparepart->delete();
        session()->flash('danger', 'Piezas de repuesto eliminar exitosamente!');
        return redirect()->route('sparepart');
    }

    public function updateFrequency(Request $request)
    {
        $sparepart = SparePart::find($request->id);

        if (!$sparepart) {
            return response()->json(['success' => false, 'message' => 'Spare part not found'], 404);
        }

        $type = $request->type;
        $value = $request->value;

        if (!in_array($type, ['frecuencia_de_limpieza', 'frecuencia_de_lubricación', 'frecuencia_de_ajuste', 'frecuencia_de_revisión', 'frecuencia_de_cambio', 'frecuencia_de_solicitud'])) {
            return response()->json(['success' => false, 'message' => 'Invalid type'], 400);
        }

        $sparepart->$type = $value;
        $sparepart->save();

        return response()->json(['success' => true, 'message' => 'Frequency updated successfully']);
    }
}
