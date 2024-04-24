<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elevators;
use App\Models\Cliente;
use App\Models\Province;


class ElevatorController extends Controller
{
    public function elevator(){
        $elevators = Elevators::all();
        $customers = Cliente::pluck('nombre','nombre');
        $provinces = Province::pluck('provincia','provincia');
        return view('elevator.view_elevator',compact('elevators','customers','provinces'));
    }

    public function elevatorInsert(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'contrato' => 'required',
            'nombre' => 'required',
            'código' => 'required',
            'marca' => 'required',
            'cliente' => 'required',
            'fecha' => 'required',
            'garantizar' => 'required',
            'dirección' => 'required',
            'ubigeo' => 'required',
            'provincia' => 'required',
            'técnico_instalador' => 'required',
            'técnico_ajustador' => 'required',
            'tipo_de_ascensor' => 'required',
            'cantidad' => 'required',
            'npisos' => 'required',
            'ncontacto' => 'required',
            'teléfono' => 'required',
            'correo' => 'required',
        ]);

        $filename = '';
        if ($request->hasFile('imagen')){
            $image = $request->file('imagen');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }

        // Create a new Elevators instance
        $elevators = Elevators::create([
            'imagen'              => $filename,
            'contrato'            => $request->input('contrato'),
            'nombre'              => $request->input('nombre'),
            'código'              => $request->input('código'),
            'marca'               => $request->input('marca'),
            'cliente'             => $request->input('cliente'),
            'fecha'               => $request->input('fecha'),
            'garantizar'          => $request->input('garantizar'),
            'dirección'           => $request->input('dirección'),
            'ubigeo'              => $request->input('ubigeo'),
            'provincia'           => $request->input('provincia'),
            'técnico_instalador'  => $request->input('técnico_instalador'),
            'técnico_ajustador'   => $request->input('técnico_ajustador'),
            'tipo_de_ascensor'    => $request->input('tipo_de_ascensor'),
            'cantidad'            => $request->input('cantidad'),
            'mgratuito'           => $request->input('mgratuito'),
            'sincuarto'           => $request->input('sincuarto'),
            'concuarto'           => $request->input('concuarto'),
            'npisos'              => $request->input('npisos'),
            'ncontacto'           => $request->input('ncontacto'),
            'teléfono'            => $request->input('teléfono'),
            'correo'              => $request->input('correo'),
            'descripcion1'        => $request->input('descripcion1'),
            'descripcion2'        => $request->input('descripcion2'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Ascensores creado exitosamente!');
        return redirect()->route('elevator');

    }

    public function elevatorEdit($id){
        $elevator = Elevators::findOrFail($id);
        return view('elevator.view_elevator',compact('elevator'));
    }


    public function elevatorUpdate(Request $request,$id){
        // dd($request->all());
        $validatedData = $request->validate([
            'contrato' => 'required',
            'nombre' => 'required',
            'código' => 'required',
            'marca' => 'required',
            'cliente' => 'required',
            'fecha' => 'required',
            'garantizar' => 'required',
            'dirección' => 'required',
            'ubigeo' => 'required',
            'provincia' => 'required',
            'técnico_instalador' => 'required',
            'técnico_ajustador' => 'required',
            'tipo_de_ascensor' => 'required',
            'cantidad' => 'required',
            'npisos' => 'required',
            'ncontacto' => 'required',
            'teléfono' => 'required',
            'correo' => 'required',
        ]);

        $elevator = Elevators::findOrFail($id);

        if ($request->hasFile('imagen')){
            $image = $request->file('imagen');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
    
            // Update the imagen attribute with the new filename
            $elevator->imagen = $filename;
        }

        //  update Elevators instance
        $elevator->update([
            'contrato'            => $request->input('contrato'),
            'nombre'              => $request->input('nombre'),
            'código'              => $request->input('código'),
            'marca'               => $request->input('marca'),
            'cliente'             => $request->input('cliente'),
            'fecha'               => $request->input('fecha'),
            'garantizar'          => $request->input('garantizar'),
            'dirección'           => $request->input('dirección'),
            'ubigeo'              => $request->input('ubigeo'),
            'provincia'           => $request->input('provincia'),
            'técnico_instalador'  => $request->input('técnico_instalador'),
            'técnico_ajustador'   => $request->input('técnico_ajustador'),
            'tipo_de_ascensor'    => $request->input('tipo_de_ascensor'),
            'cantidad'            => $request->input('cantidad'),
            'mgratuito'           => $request->input('mgratuito'),
            'sincuarto'           => $request->input('sincuarto'),
            'concuarto'           => $request->input('concuarto'),
            'npisos'              => $request->input('npisos'),
            'ncontacto'           => $request->input('ncontacto'),
            'teléfono'            => $request->input('teléfono'),
            'correo'              => $request->input('correo'),
            'descripcion1'        => $request->input('descripcion1'),
            'descripcion2'        => $request->input('descripcion2'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Ascensores actualizado exitosamente!');
        return redirect()->route('elevator');

    }

    public function elevatorView(Request $request, $id){
        $elevator = Elevators::find($id);
        $customers = Cliente::pluck('nombre','nombre');
        $provinces = Province::pluck('provincia','provincia');

        return view('elevator.view_elevator_details',compact('elevator', 'customers','provinces'));

    }

    public function elevatorDestroy($id){
        $elevator = Elevators::find($id);
        $elevator->delete();
        session()->flash('danger', 'Ascensores eliminar exitosamente!');
        return redirect()->back();
    }

}
