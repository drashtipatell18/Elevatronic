<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class CustomerController extends Controller
{
    public function customer(){
        $customers = Cliente::all();
        return view('customer.view_customer',compact('customers'));
    }


    public function customerInsert(Request $request){
        $validatedData = $request->validate([
            'nombre' => 'required',
            'tipo_de_cliente' => 'required',
            'ruc' => 'required',
            'país' => 'required',
            'provincia' => 'required',
            'dirección' => 'required',
            'teléfono' => 'required',
            'teléfono_móvil' => 'required',
            'correo_electrónico' => 'required',
            'nombre_del_contacto' => 'required',
            'posición' => 'required',
        ]);

        // Create a new Customer instance
        $customer = Cliente::create([
            'nombre'              => $request->input('nombre'),
            'tipo_de_cliente'     => $request->input('tipo_de_cliente'),
            'ruc'                 => $request->input('ruc'),
            'provincia'           => $request->input('provincia'),
            'país'                => $request->input('país'),
            'dirección'           => $request->input('dirección'),
            'teléfono'            => $request->input('teléfono'),
            'teléfono_móvil'      => $request->input('teléfono_móvil'),
            'correo_electrónico'  => $request->input('correo_electrónico'),
            'nombre_del_contacto' => $request->input('nombre_del_contacto'),
            'posición'            => $request->input('posición'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Cliente created successfully!');
        return redirect()->route('customer');

    }

    public function customerView(Request $request, $id){
        $customers = Cliente::find($id);
        return view('customer.view_customer_details',compact('customers'));

    }

    public function customerEdit($id){
        $customer = Cliente::findOrFail($id);
        return view('customer.view_customer',compact('customer'));

    }

    public function customerUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'nombre' => 'required',
            'tipo_de_cliente' => 'required',
            'ruc' => 'required',
            'país' => 'required',
            'provincia' => 'required',
            'dirección' => 'required',
            'teléfono' => 'required',
            'teléfono_móvil' => 'required',
            'correo_electrónico' => 'required',
            'nombre_del_contacto' => 'required',
            'posición' => 'required',
        ]);

        $customers = Cliente::findOrFail($id);
        // Create a new Customer instance
        $customers->update([
            'nombre'              => $request->input('nombre'),
            'tipo_de_cliente'     => $request->input('tipo_de_cliente'),
            'ruc'                 => $request->input('ruc'),
            'provincia'           => $request->input('provincia'),
            'país'                => $request->input('país'),
            'dirección'           => $request->input('dirección'),
            'teléfono'            => $request->input('teléfono'),
            'teléfono_móvil'      => $request->input('teléfono_móvil'),
            'correo_electrónico'  => $request->input('correo_electrónico'),
            'nombre_del_contacto' => $request->input('nombre_del_contacto'),
            'posición'            => $request->input('posición'),
        ]);

        session()->flash('success', 'Cliente Updated successfully!');
        return redirect()->route('customer');

    }

    public function customerDestroy($id){
        $customers = Cliente::find($id);
        $customers->delete();
        session()->flash('danger', 'Cliente Delete successfully!');
        return redirect()->back();
    }
}
