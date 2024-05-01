<?php

namespace App\Http\Controllers\Elevatortypes;

use App\Http\Controllers\Controller;
use App\Models\Elevatortypes\Elevatortypes;
use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\Elevators;

class ElevatortypesController extends Controller
{
    public function Elevatortypes(){  
        $elevator_types = Elevatortypes::all();      
        return view('ElevatorTypes.view_elevator_types',compact('elevator_types'));
    }

    public function elevatortypesInsert(Request $request){
        $validatedData = $request->validate([
            'nombre_de_tipo_de_ascensor' => 'required',
        ]);

        // Create a new Customer instance
        $elevator_type = Elevatortypes::create([
            'nombre_de_tipo_de_ascensor'  => $request->input('nombre_de_tipo_de_ascensor'),
           
        ]);

        // Redirect back with success message
        session()->flash('success', 'Tipos de ascensor creado exitosamente!');
        return redirect()->route('elevatortypes');
    }

    public function elevatortypesEdit($id){
        $elevatortypes = Elevatortypes::findOrFail($id);
        return view('ElevatorTypes.view_elevator_types', compact('elevatortypes'));

    }
    
    public function elevatortypesDetails($id){
        $elevator_type = Elevatortypes::findOrFail($id);
        $spareparts = SparePart::all();
        $elevators = Elevators::all();
        return view('ElevatorTypes.elevator_details', compact('elevators','spareparts','elevator_type'));
    }

    public function elevatortypesUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'nombre_de_tipo_de_ascensor' => 'required',
        ]);

        $elevator_type = Elevatortypes::findOrFail($id);

        // Create a new elevator_type instance
        $elevator_type->update([
            'nombre_de_tipo_de_ascensor'  => $request->input('nombre_de_tipo_de_ascensor'),
           
        ]);

        // Redirect back with success message
        session()->flash('success', 'Tipos de ascensor actualizado exitosamente!');
        return redirect()->route('elevatortypes');
    }

    public function elevatortypesDestroy($id){
        $elevator_type = Elevatortypes::find($id);
        $elevator_type->delete();
        session()->flash('danger', 'Tipos de ascensor eliminar exitosamente!');
        return redirect()->back();
    }
    
}    
