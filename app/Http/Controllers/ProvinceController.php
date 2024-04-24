<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function province(){
        $provinces = Province::all();
        return view('province.view_province',compact('provinces'));
    }

    public function provinceInsert(Request $request){
        $validatedData = $request->validate([
            'provincia' => 'required',
        ]);

        // Create a new Province instance
        $province = Province::create([
            'provincia' => $request->input('provincia'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Provincia creado exitosamente!');
        return redirect()->route('province');

    }

    public function provinceEdit($id){
        $province = Province::findOrFail($id);
        return view('provice.view_provice',compact('province'));
    }

    public function provinceView($id){
        $province = Province::findOrFail($id);
        return view('province.view_province_details',compact('province'));
    }

    public function provinceUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'provincia' => 'required',
        ]);

        $province = Province::findOrFail($id);

        // Update a new Province instance
        $province->update([
            'provincia' => $request->input('provincia'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Provincia actualizado exitosamente!');
        return redirect()->route('province');
    }

    public function provinceDestroy($id){
        $province = Province::find($id);
        $province->delete();
        session()->flash('danger', 'Provincia eliminar exitosamente!');
        return redirect()->back();
    }
}
   
