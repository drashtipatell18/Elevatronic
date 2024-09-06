<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewType;
use App\Models\MaintInReview;
use App\Models\Schedule;

class ReviewTypeController extends Controller
{
    public function reviewtype(){
        $reviewtypes = ReviewType::all();
        return view('reviewtype.view_reviewtype',compact('reviewtypes'));
    }

    public function reviewtypeInsert(Request $request){
        $validatedData = $request->validate([
            'nombre' => 'required',
        ]);

        // Create a new Province instance
        $reviewtype = ReviewType::create([
            'nombre' => $request->input('nombre'),
            // 'descripción' => $request->input('descripción')
        ]);

        // Redirect back with success message
        session()->flash('success', 'Tipo de revisión creado exitosamente!');
        return redirect()->route('reviewtype');

    }

    public function reviewtypeEdit($id){
        $reviewtype = ReviewType::findOrFail($id);
        return view('reviewtype.view_reviewtype',compact('reviewtype'));
    }


    public function reviewtypeUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'nombre' => 'required',
        ]);

        $reviewtype = ReviewType::findOrFail($id);
        $oldTypeName = $reviewtype->nombre;
        $oldTypeId = $reviewtype->id; // Use ID instead of name

        // Update a new Province instance
        $reviewtype->update([
            'nombre' => $request->input('nombre'),
            // 'descripción' => $request->input('descripción')
        ]);
        MaintInReview::where('tipo_de_revisión', $oldTypeId)
        ->update(['tipo_de_revisión' => $reviewtype->id]);
        Schedule::where('revisar', $oldTypeName)
        ->update(['revisar' => $request->input('nombre')]);

        // Redirect back with success message
        session()->flash('success', 'Tipo de revisión actualizado exitosamente!');
        return redirect()->route('reviewtype');
    }

    public function reviewtypeDestroy($id){
        $reviewtype = ReviewType::find($id);
        $reviewtype->delete();
        session()->flash('danger', 'Tipo de revisión eliminar exitosamente!');
        return redirect()->back();
    }
}
