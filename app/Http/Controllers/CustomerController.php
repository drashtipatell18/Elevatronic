<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Province;
use App\Models\CustomerType;

class CustomerController extends Controller
{
    public function customer(){
        $customers = Cliente::all();
        // dd($customers);
        $provinces = Province::pluck('provincia', 'provincia');
        return view('customer.view_customer',compact('customers','provinces'));
    }

    public function customerInsert(Request $request){
        $validatedData = $request->validate([
            'nombre' => 'required',
            'tipo_de_cliente' => 'required',
            'ruc' => 'required|numeric|digits:11',
            'país' => 'required',
            'provincia' => 'required',
            'dirección' => 'required',
            'teléfono' => 'required|numeric|digits:9',
            'teléfono_móvil' => 'required|numeric|digits:9',
            'correo_electrónico' => 'required',
            'nombre_del_contacto' => 'required',
            // 'posición' => 'required',
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
        session()->flash('success', 'Cliente creado exitosamente!');
        return redirect()->route('customer');

    }

    public function insertCustomerType(Request $request)
    {
        CustomerType::create([
            'tipo_de_client' => $request->input('tipo_de_client'),
        ]);

        return response()->json(['success' => 'CustomerType added successfully!']);
    }

    public function getCustomerTypes(){
        return response()->json(CustomerType::all());
    }

    public function customerView(Request $request, $id){
        $customer = Cliente::findOrFail($id);
        if (!$customer) {
            return response()->view('errors.client_not_found', [], 404);
        }
        $provinces = Province::pluck('provincia', 'provincia');
        return view('customer.view_customer_details',compact('customer','provinces'));

    }

    public function customerEdit($id){
        $customer = Cliente::findOrFail($id);
        return view('customer.view_customer',compact('customer'));

    }

    public function customerUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'nombre' => 'required',
            'tipo_de_cliente' => 'required',
            'ruc' => 'required|numeric|digits:11',
            'país' => 'required',
            'provincia' => 'required',
            'dirección' => 'required',
            'teléfono' => 'required|numeric|digits:9',
            'teléfono_móvil' => 'required|numeric|digits:9',
            'correo_electrónico' => 'required',
            'nombre_del_contacto' => 'required',
            // 'posición' => 'required',
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

        session()->flash('success', 'Cliente actualizado exitosamente!');
        return redirect()->route('customer');

    }

    public function customerDestroy($id){
        $customers = Cliente::find($id);
        $customers->delete();
        session()->flash('danger', 'Cliente eliminar exitosamente!');
        return redirect()->route('customer');
    }
}
