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
    public function elevator(Request $request) // Added Request parameter
    {
        $elevators = Elevators::with(['client','tecnicoAjustador','tecnicoInstalador','province','tipoDeAscensor'])->get();
        $customers = Cliente::pluck('nombre', 'id');
        $allCustomers = Cliente::all();
        $provinces = Province::pluck('provincia', 'id');
        $elevatortypes = Elevatortypes::pluck('nombre_de_tipo_de_ascensor', 'id');
        $staffs = Staff::pluck('nombre', 'id');

        if ($request->ajax()) { // Check if the request is an AJAX call
            return response()->json(compact('elevators', 'allCustomers', 'customers', 'provinces', 'elevatortypes', 'staffs'));
        }

        return view('elevator.view_elevator', compact('elevators', 'allCustomers', 'customers', 'provinces', 'elevatortypes', 'staffs'));
    }

    public function getBrands()
    {
        return response()->json(Marca::all());
    }

    public function getData()
    {
        // Return all data in a single response array
        return response()->json([
            'clientes' => Cliente::pluck('nombre','id')->toArray(), // Convert to array
            'provincias' => Province::pluck('provincia','id')->toArray(), // Convert to array
            'elevatortypes' => Elevatortypes::pluck('nombre_de_tipo_de_ascensor','id')->toArray(), // Convert to array
            'staffs' => Staff::pluck('nombre','id')->toArray(), // Convert to array
        ]);
    }
    public function insertBrand(Request $request)
    {
        Marca::create([
            'marca_nombre' => $request->input('marca_nombre'),
        ]);

        return response()->json(['success' => 'Brand added successfully!']);
    }
    public function getElevators(Request $request) {
        $province = $request->input('province'); // Get the province from the request
        // Fetch elevators based on the selected province
        $elevators = Elevators::where('provincia', $province)->get()->toArray();
              
        return response()->json($elevators); // Return the elevators as a JSON response
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
            'marca_id'            => $request->input('marca_id'),
            'client_id'           => $request->input('client_id'),
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

    public function maintInReviewInsertelevator(Request $request, $id)
    {
        // dd($request->all());
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'tipo_de_revisión' => 'required',
                'técnico' => 'required',
                'fecha_de_mantenimiento' => 'required|date',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'núm_certificado' => 'required',
            ]);

            // Fetch the elevator data
            $elevator = Elevators::findOrFail($id);

            // Create a new MaintInReview instance
            $maintinreview = MaintInReview::create([
                'tipo_de_revisión' => $request->input('tipo_de_revisión'),
                'ascensor' => $elevator->id,
                'dirección' => $elevator->dirección,
                'provincia' => $request->input('provincia'),
                'núm_certificado' => $request->input('núm_certificado'),
                'supervisor_id' => $request->input('supervisor_id'),
                'técnico' => $request->input('técnico'),
                'mes_programado' => $request->input('mes_programado'),
                'fecha_de_mantenimiento' => $request->input('fecha_de_mantenimiento'),
                'hora_inicio' => $request->input('hora_inicio'),
                'hora_fin' => $request->input('hora_fin'),
                'observaciónes' => $request->input('observaciónes') ?? null,
                'observaciónes_internas' => $request->input('observaciónes_internas') ?? null,
                'solución' => $request->input('solución'),
            ]);

            // Redirect back with success message
            return redirect()->route('ascensore')->with('success', 'Mant En Revisión creado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear Mant En Revisión: ' . $e->getMessage())->withInput();
        }
    }

    public function elevatorEdit($id)
    {
        $elevator = Elevators::findOrFail($id);
        $allCustomers = Cliente::all();
        return view('elevator.view_elevator', compact('elevator'));
    }


    public function elevatorUpdate(Request $request, $id)
    {
        // dd($request->all());
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
        // dd($quarters);

        //  update Elevators instance
        $elevator->update([
            'contrato'            => $request->input('contrato'),
            'nombre'              => $request->input('nombre'),
            'código'              => $request->input('código'),
            'marca_id'            => $request->input('marca_id'),
            'client_id'           => $request->input('client_id'),
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
        $elevators = Elevators::with(['client','tecnicoAjustador','tecnicoInstalador','province','tipoDeAscensor','marca'])->find($id);
        $contracts = Contract::where('ascensor', $elevators->id)->get();
        $spareparts = SparePart::all();
        $customers = Cliente::pluck('nombre', 'id');
        $provinces = Province::pluck('provincia', 'id');
        $maint_in_reviews = MaintInReview::with('reviewtype')->where('ascensor', $elevators->id)->get();
        $elevatornumber = Elevators::pluck('nombre', 'nombre');
        $review_types  = ReviewType::pluck('nombre', 'id');
        $elevatortypes = Elevatortypes::pluck('nombre_de_tipo_de_ascensor', 'id');
        $staffs = Staff::pluck('nombre', 'id');
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
        return redirect()->route('elevator')->with('success', 'Contract creado exitosamente!');
    }

    public function contractUpdate(Request $request, $id)
    {
        // dd($request->all);
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

        $contract = Contract::find($id); // Change to find() for debugging
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
            'observación'           => $request->input('observación'),
            'estado_cuenta_del_contrato' => $request->input('estado_cuenta_del_contrato'),
            'estado'            => strtolower($request->input('estado')),
        ]);

        // session()->flash('success', 'Contract actualizado exitosamente!');
        // return redirect()->route('ascensore');
        return redirect()->route('elevator')->with('success', 'Contract actualizado exitosamente!');

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
