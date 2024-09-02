<?php

namespace App\Http\Controllers\Elevatortypes;

use App\Http\Controllers\Controller;
use App\Models\Elevatortypes\Elevatortypes;
use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\Elevators;
use App\Models\AssginSpare;

class ElevatortypesController extends Controller
{
    public function Elevatortypes(){
        $elevator_types = Elevatortypes::all();
        // dd($elevator_types);
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
        $elevators = Elevators::where('tipo_de_ascensor', $elevator_type->id)->get();
        $assginspares = AssginSpare::where('nombre_del_tipo_de_ascensor', $elevator_type->nombre_de_tipo_de_ascensor)
        ->get();
        return view('ElevatorTypes.elevator_details', compact('assginspares','elevators','spareparts','elevator_type'));
    }

    public function AsignarRepuesto(Request $request){
        $validatedData = $request->validate([
            'nombre_del_tipo_de_ascensor' => 'required',
            'repuesto_id' => 'required',
        ]);

        // Create a new Customer instance
        $assginspare = AssginSpare::create([
            'nombre_del_tipo_de_ascensor'  => $request->input('nombre_del_tipo_de_ascensor'),
            'repuesto_id'                   => $request->input('repuesto_id'),

        ]);

        // Redirect back with success message
        session()->flash('success', 'Asignar repuesto creado exitosamente!');
        return redirect()->route('elevatortypes');
    }

    public function elevatortypesUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre_de_tipo_de_ascensor' => 'required',
        ]);
        $elevator_type = Elevatortypes::findOrFail($id);
        $oldTypeName = $elevator_type->nombre_de_tipo_de_ascensor;
        $elevator_type->update([
            'nombre_de_tipo_de_ascensor' => $request->input('nombre_de_tipo_de_ascensor'),
        ]);
        AssginSpare::where('nombre_del_tipo_de_ascensor', $oldTypeName)
                   ->update(['nombre_del_tipo_de_ascensor' => $request->input('nombre_de_tipo_de_ascensor')]);

        Elevators::where('tipo_de_ascensor', $oldTypeName)
                 ->update(['tipo_de_ascensor' => $request->input('nombre_de_tipo_de_ascensor')]);

        session()->flash('success', 'Tipos de ascensor actualizado exitosamente!');
        return redirect()->route('elevatortypes');
    }



    public function elevatortypesDestroy($id){
        $elevator_type = Elevatortypes::find($id);
        $elevator_type->delete();
        session()->flash('danger', 'Tipos de ascensor eliminar exitosamente!');
        return redirect()->route('elevatortypes');
    }

}
