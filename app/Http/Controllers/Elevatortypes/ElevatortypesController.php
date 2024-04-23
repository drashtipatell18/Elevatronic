<?php

namespace App\Http\Controllers\Elevatortypes;

use App\Http\Controllers\Controller;
use App\Models\Elevatortypes\Elevatortypes;
use Illuminate\Http\Request;

class ElevatortypesController extends Controller
{
    public function Elevatortypes(){
        // $elevator_types = Elevatortypes::all();
        return view('ElevatorTypes.view_elevator_types');
    }

    // public function customerCreate(){
    //     return view('ElevatorTypes.create_elevator_types');
    // }
    public function elevatortypesInsert(Request $request){
        $validatedData = $request->validate([
            'nombre_de_tipo_de_ascensor' => 'required',
        ]);

        // Create a new Customer instance
        $elevatortypes = Elevatortypes::create([
            'nombre_de_tipo_de_ascensor'  => $request->input('nombre_de_tipo_de_ascensor'),
           
        ]);

        // Redirect back with success message
        session()->flash('success', 'Cliente created successfully!');
        return redirect()->route('elevatortypes');
    }
}
