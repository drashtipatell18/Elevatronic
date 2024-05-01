<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contract;
use App\Models\Elevators;
use App\Models\SparePart;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function contract(){
        $contracts = Contract::all();
        $spareparts = SparePart::all();
        $elevators = Elevators::all();
        $customers = Cliente::all();
        return view('elevator.view_elevator_details',compact('contracts','spareparts','elevators','customers'));
    }

    public function contractInsert(Request $request){
        $validatedData = $request->validate([
            'ascensor' => 'required',
            'fecha_de_propuesta' => 'required',
            'monto_de_propuesta' => 'required',
            'monto_de_contrato' => 'required',
            'fecha_de_inicio' => 'required',
            'fecha_de_fin' => 'required',
            'cada_cuantos_meses' => 'required',
            'observación' => 'required',
            'estado_cuenta_del_contrato' => 'required',
            'estado' => 'required',
        ]);

        // Create a new Contract instance
        $contract = Contract::create([
            'ascensor'              => $request->input('ascensor'),
            'fecha_de_propuesta'     => $request->input('fecha_de_propuesta'),
            'monto_de_propuesta'                 => $request->input('monto_de_propuesta'),
            'monto_de_contrato'           => $request->input('monto_de_contrato'),
            'fecha_de_inicio'                => $request->input('fecha_de_inicio'),
            'fecha_de_fin'           => $request->input('fecha_de_fin'),
            'renovación'            => $request->input('renovación'),
            'cada_cuantos_meses'      => $request->input('cada_cuantos_meses'),
            'observación'  => $request->input('observación'),
            'estado_cuenta_del_contrato' => $request->input('estado_cuenta_del_contrato'),
            'estado'            => $request->input('estado'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'creado Contract exitosamente!');
        return redirect()->route('contract');

    }

    // public function customerView(Request $request, $id){
    //     $contract = Contract::find($id);
    //     return view('customer.view_customer_details',compact('contract'));

    // }

    public function contractEdit($id){
        $contract = Contract::findOrFail($id);
        $elevator = Elevators::find($id);
        $customers = Cliente::find($id);
        // dd($elevator);
        return view('elevator.view_elevator_details',compact('contract','elevator','customers'));
    }
    public function contractUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'ascensor' => 'required',
            'fecha_de_propuesta' => 'required',
            'monto_de_propuesta' => 'required',
            'monto_de_contrato' => 'required',
            'fecha_de_inicio' => 'required',
            'fecha_de_fin' => 'required',
            'cada_cuantos_meses' => 'required',
            'observación' => 'required',
            'estado_cuenta_del_contrato' => 'required',
            'estado' => 'required',
        ]);

        $contract = Contract::findOrFail($id);
        // Create a new Contract instance
        $contract->update([
            'ascensor'              => $request->input('ascensor'),
            'fecha_de_propuesta'     => $request->input('fecha_de_propuesta'),
            'monto_de_propuesta'       => $request->input('monto_de_propuesta'),
            'monto_de_contrato'        => $request->input('monto_de_contrato'),
            'fecha_de_inicio'          => $request->input('fecha_de_inicio'),
            'fecha_de_fin'           => $request->input('fecha_de_fin'),
            'renovación'            => $request->input('renovación'),
            'cada_cuantos_meses'      => $request->input('cada_cuantos_meses'),
            'observación'  => $request->input('observación'),
            'estado_cuenta_del_contrato' => $request->input('estado_cuenta_del_contrato'),
            'estado'            => $request->input('estado'),
        ]);

        session()->flash('success', 'Contract actualizado exitosamente!');
        return redirect()->route('customer');

    }

    public function contractDestroy($id){
        $contract = Contract::find($id);
        $elevator = Elevators::find($id);
        
        if (!$elevator) {
            abort(404); // Or handle the case where $elevator is not found
        }
        
        $contract->delete();
        session()->flash('danger', 'Contract eliminado exitosamente!');
        return redirect()->back();
    }
    
    
}
