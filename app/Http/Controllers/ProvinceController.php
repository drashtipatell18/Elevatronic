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
}
   
