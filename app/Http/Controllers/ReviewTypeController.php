<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewType;
use App\Models\SparePart;

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

        // Update a new Province instance
        $reviewtype->update([
            'nombre' => $request->input('nombre'),
        ]);

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
