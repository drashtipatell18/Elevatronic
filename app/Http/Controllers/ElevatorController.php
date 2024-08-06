<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elevators;
use App\Models\Cliente;
use App\Models\Province;
use App\Models\SparePart;
use App\Models\Marca;
use App\Models\Contract;
use App\Models\MaintInReview;
use App\Models\ReviewType;
use App\Models\Elevatortypes\Elevatortypes;
use App\Models\Staff;

class ElevatorController extends Controller
{
    public function elevator()
    {
        $elevators = Elevators::all();
        // $customers = Cliente::pluck('nombre', 'nombre');
        $customers = Cliente ::all();

        $provinces = Province::pluck('provincia', 'provincia');
        $elevatortypes = Elevatortypes::pluck('nombre_de_tipo_de_ascensor', 'nombre_de_tipo_de_ascensor');
        $staffs = Staff::pluck('nombre', 'nombre');
        return view('elevator.view_elevator', compact('elevators', 'customers', 'provinces', 'elevatortypes', 'staffs'));
    }

    public function getBrands()
    {
        return response()->json(Marca::all());
    }

    public function insertBrand(Request $request)
    {
        Marca::create([
            'marca_nombre' => $request->input('marca_nombre'),
        ]);

        return response()->json(['success' => 'Brand added successfully!']);
    }
    public function elevatorInsert(Request $request)
    {

        $filename = '';
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }

        if (is_array($request->input('quarters'))) {
            $quarters = implode(',', $request->input('quarters'));
        } else {
            $quarters = $request->input('quarters');
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
            'quarters'            => $quarters,
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

    public function elevatorEdit($id)
    {
        $elevator = Elevators::findOrFail($id);
        return view('elevator.view_elevator', compact('elevator'));
    }


    public function elevatorUpdate(Request $request, $id)
    {

        $elevator = Elevators::findOrFail($id);

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);

            // Update the imagen attribute with the new filename
            $elevator->imagen = $filename;
        }
        if (is_array($request->input('quarters'))) {
            $quarters = implode(',', $request->input('quarters'));
        } else {
            $quarters = $request->input('quarters');
        }
        $oldElevatorName = $elevator->nombre;

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
            'quarters'            => $quarters,
            'npisos'              => $request->input('npisos'),
            'ncontacto'           => $request->input('ncontacto'),
            'teléfono'            => $request->input('teléfono'),
            'correo'              => $request->input('correo'),
            'descripcion1'        => $request->input('descripcion1'),
            'descripcion2'        => $request->input('descripcion2'),
        ]);
        Contract::where('ascensor', $oldElevatorName)
            ->update(['ascensor' => $request->input('nombre')]);
        MaintInReview::where('ascensor', $oldElevatorName)
            ->update(['ascensor' => $request->input('nombre')]);

        // Redirect back with success message
        session()->flash('success', 'Ascensores actualizado exitosamente!');
        return redirect()->route('elevator');
    }

    public function elevatorView(Request $request, $id)
    {
        $elevators = Elevators::find($id);
        $contracts = Contract::where('ascensor', $elevators->nombre)->get();
        $spareparts = SparePart::all();
        $customers = Cliente::pluck('nombre', 'nombre');
        $provinces = Province::pluck('provincia', 'provincia');
        $maint_in_reviews = MaintInReview::where('ascensor', $elevators->nombre)->get();
        $elevatornumber = Elevators::pluck('nombre', 'nombre');
        $review_types  = ReviewType::pluck('nombre', 'nombre');
        $elevatortypes = Elevatortypes::pluck('nombre_de_tipo_de_ascensor', 'nombre_de_tipo_de_ascensor');
        $staffs = Staff::pluck('nombre', 'nombre');
        return view('elevator.view_elevator_details', compact('elevatortypes', 'staffs', 'elevators', 'elevatornumber', 'review_types', 'maint_in_reviews', 'spareparts', 'customers', 'provinces', 'contracts'));
    }

    public function contractInsert(Request $request)
    {
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
            'ascensor'                   => $request->input('ascensor'),
            'fecha_de_propuesta'         => $request->input('fecha_de_propuesta'),
            'monto_de_propuesta'         => $request->input('monto_de_propuesta'),
            'monto_de_contrato'          => $request->input('monto_de_contrato'),
            'fecha_de_inicio'            => $request->input('fecha_de_inicio'),
            'fecha_de_fin'               => $request->input('fecha_de_fin'),
            'renovación'                 => $request->input('renovación'),
            'cada_cuantos_meses'         => $request->input('cada_cuantos_meses'),
            'observación'                => $request->input('observación'),
            'estado_cuenta_del_contrato' => $request->input('estado_cuenta_del_contrato'),
            'estado'                     => strtolower($request->input('estado')),
        ]);

        // Redirect back with success message
        session()->flash('success', 'creado Contract exitosamente!');
        return redirect()->route('elevator');
    }

    public function contractUpdate(Request $request, $id)
    {
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
            'estado'            => strtolower($request->input('estado')),
        ]);

        session()->flash('success', 'Contract actualizado exitosamente!');
        return redirect()->route('elevator');
    }

    public function contractDestroy($id)
    {
        $contract = Contract::find($id);
        $contract->delete();
        session()->flash('danger', 'Contract eliminado exitosamente!');
        return redirect()->back();
    }


    public function elevatorDestroy($id)
    {
        $elevator = Elevators::find($id);
        $elevator->delete();
        session()->flash('danger', 'Ascensores eliminar exitosamente!');
        return redirect()->route('elevator');
    }

    public function getContract($id)
    {
        $contracts = Contract::find($id);
        return response()->json($contracts);
    }
}
