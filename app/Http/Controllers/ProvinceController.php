<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\SparePart;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use App\Models\Elevators;
use App\Models\Staff;
use App\Models\Elevatortypes\Elevatortypes;

class ProvinceController extends Controller
{
    public function province(){
        $provinces = Province::all();
        $customers = Cliente::pluck('provincia','id');
        return view('province.view_province',compact('provinces','customers'));
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

    public function provinceView(Request $request, $id)
    {
        $province = Province::findOrFail($id);
        // echo '<pre>';
        // print_r($province);
        // echo '</pre>';
        $customers = Cliente::pluck('nombre','nombre');
        $staffs = Staff::pluck('nombre','nombre');
        $elevatortypes = Elevatortypes::pluck('nombre_de_tipo_de_ascensor','nombre_de_tipo_de_ascensor');
        $elevators = Elevators::where('provincia', $province->provincia)->get();
        // echo '<pre>';
        // print_r($elevators);
        // echo '</pre>';exit;
        $spareparts = SparePart::all();
        return view('province.view_province_details', compact('province','staffs', 'customers', 'elevators', 'elevatortypes','spareparts'));
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


    public function provinceDestroy($id)
    {
        $province = Province::find($id);

        if (!$province) {
            session()->flash('danger', 'Provincia no encontrada!');
            return redirect()->back();
        }

        $provincename = $province->provincia;
        $customers = Cliente::where('provincia', $provincename)->get();

        if ($customers->isNotEmpty()) {
            session()->flash('customers', $customers);
            session()->flash('province_id', $id);
            return redirect()->back();
        }

        $province->delete();
        session()->flash('success', 'Provincia eliminada exitosamente!');
        return redirect()->route('province');
    }

    public function provinceForceDestroy(Request $request, $id)
    {
        $province = Province::find($id);

        if (!$province) {
            session()->flash('danger', 'Provincia no encontrada!');
            return redirect()->back();
        }

        $provincename = $province->provincia;
        $customers = Cliente::where('provincia', $provincename)->get();

        DB::beginTransaction();
        try {
            foreach ($customers as $customer) {
                $customer->delete();
            }

            $province->delete();
            DB::commit();
            session()->flash('success', 'Provincia y sus clientes eliminados exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('danger', 'Hubo un error al eliminar la provincia y sus clientes.');
        }

        return redirect()->back();
    }

}

