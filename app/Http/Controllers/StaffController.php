<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Position;

class StaffController extends Controller
{
    public function staff(){
        $staffs = Staff::all();
        return view('staff.view_staff', compact('staffs'));
    }

    public function staffInsert(Request $request){
        $validatedData = $request->validate([
            'nombre' => 'required',
            'posición' => 'required',
            // 'correo' => 'required',
            // 'teléfono' => 'required',
        ]);

        $filename = '';
        if ($request->hasFile('personalfoto')){
            $image = $request->file('personalfoto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }

        $staff = Staff::create([
            'personalfoto'           => $filename,
            'nombre'              => $request->input('nombre'),
            'posición'            => $request->input('posición'),
            'correo'              => $request->input('correo'),
            'teléfono'            => $request->input('teléfono'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Personal creado exitosamente!');
        return redirect()->route('staff');
    }

    public function getPosition()
    {
        return response()->json(Position::all());
    }

    public function insertPosition(Request $request)
    {
        Position::create([
            'position' => $request->input('position'),
        ]);

        return response()->json(['success' => 'Position added successfully!']);
    }
    public function staffUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'nombre' => 'required',
            'posición' => 'required',
            // 'correo' => 'required',
            // 'teléfono' => 'required',
        ]);

        $staff = Staff::findOrFail($id);

        if ($request->hasFile('personalfoto')){
            $image = $request->file('personalfoto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);

            // Update the imagen attribute with the new filename
            $staff->personalfoto = $filename;
        }

        //  update Elevators instance
        $staff->update([
            'nombre'              => $request->input('nombre'),
            'posición'            => $request->input('posición'),
            'correo'              => $request->input('correo'),
            'teléfono'            => $request->input('teléfono'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Personal actualizado exitosamente!');
        return redirect()->route('staff');

    }

    public function staffView(Request $request, $id){
        $staffs = Staff::find($id);
        return view('staff.view_staff_record',compact('staffs'));

    }

    public function staffDestroy($id){
        $staffs = Staff::find($id);
        $staffs->delete();
        session()->flash('danger', 'Personal eliminar exitosamente!');
        return redirect()->route('staff');
    }

}
