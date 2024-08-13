<?php

namespace App\Http\Controllers;

use App\Models\AssginSpare;
use App\Models\Cliente;
use App\Models\Contract;
use App\Models\CustomerType;
use App\Models\Elevators;
use App\Models\Elevatortypes\Elevatortypes;
use App\Models\ImagePdfs;
use App\Models\Maintenance;
use App\Models\MaintInReview;
use App\Models\Marca;
use App\Models\Position;
use App\Models\Province;
use App\Models\ReviewType;
use App\Models\Schedule;
use App\Models\SparePart;
use App\Models\Staff;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->input('query'));
        // Search in AssginSpare table
        $assignSpares = AssginSpare::where('nombre_del_tipo_de_ascensor', 'LIKE', "%{$query}%")
            ->orWhere('repuesto_id', 'LIKE', "%{$query}%")
            ->get();

        // Search in Cliente table
        $clientes = Cliente::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('tipo_de_cliente', 'LIKE', "%{$query}%")
            ->orWhere('ruc', 'LIKE', "%{$query}%")
            ->orWhere('país', 'LIKE', "%{$query}%")
            ->orWhere('provincia', 'LIKE', "%{$query}%")
            ->orWhere('dirección', 'LIKE', "%{$query}%")
            ->orWhere('teléfono', 'LIKE', "%{$query}%")
            ->orWhere('teléfono_móvil', 'LIKE', "%{$query}%")
            ->orWhere('correo_electrónico', 'LIKE', "%{$query}%")
            ->orWhere('nombre_del_contacto', 'LIKE', "%{$query}%")
            ->orWhere('posición', 'LIKE', "%{$query}%")
            ->get();

        // Search in Contract table
        $contracts = Contract::where('ascensor', 'LIKE', "%{$query}%")
            ->orWhere('fecha_de_propuesta', 'LIKE', "%{$query}%")
            ->orWhere('monto_de_propuesta', 'LIKE', "%{$query}%")
            ->orWhere('monto_de_contrato', 'LIKE', "%{$query}%")
            ->orWhere('fecha_de_inicio', 'LIKE', "%{$query}%")
            ->orWhere('fecha_de_fin', 'LIKE', "%{$query}%")
            ->orWhere('renovación', 'LIKE', "%{$query}%")
            ->orWhere('cada_cuantos_meses', 'LIKE', "%{$query}%")
            ->orWhere('observación', 'LIKE', "%{$query}%")
            ->orWhere('estado_cuenta_del_contrato', 'LIKE', "%{$query}%")
            ->orWhere('estado', 'LIKE', "%{$query}%")
            ->get();

        // Search in Custimer Type table
        $customerTypes = CustomerType::where('tipo_de_client', 'LIKE', "%{$query}%")->get();


        // MaintinRevieew search table
        $maininReview = MaintInReview::where('tipo_de_revisión', 'LIKE', "%{$query}%")
        ->orWhere('ascensor', 'LIKE', "%{$query}%")
        ->orWhere('dirección', 'LIKE', "%{$query}%")
        ->orWhere('provincia', 'LIKE', "%{$query}%")
        ->orWhere('supervisor', 'LIKE', "%{$query}%")
        ->orWhere('técnico', 'LIKE', "%{$query}%")
        ->orWhere('mes_programado', 'LIKE', "%{$query}%")
        ->orWhere('fecha_de_mantenimiento', 'LIKE', "%{$query}%")
        ->orWhere('hora_inicio', 'LIKE', "%{$query}%")
        ->orWhere('hora_fin', 'LIKE', "%{$query}%")
        ->orWhere('observaciónes', 'LIKE', "%{$query}%")
        ->orWhere('observaciónes_internas', 'LIKE', "%{$query}%")
        ->orWhere('solución', 'LIKE', "%{$query}%")
        ->get();

        //Position table search
        $positions = Position::where('position', 'LIKE', "%{$query}%")->get();

        //Province table search
        $province = Province::where('provincia', 'LIKE', "%{$query}%")->get();

        // Review type search
        $reviewType = ReviewType::whereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$query}%"])->get();
        // Staff Search table
        $staff = Staff::where('personalfoto', 'LIKE', "%{$query}%")
        ->orWhere('nombre', 'LIKE', "%{$query}%")
        ->orWhere('posición', 'LIKE', "%{$query}%")
        ->orWhere('correo', 'LIKE', "%{$query}%")
        ->orWhere('teléfono', 'LIKE', "%{$query}%")
        ->get();


        // User search
        $users = User::where('username', 'LIKE', "%{$query}%")
        ->orWhere('name', 'LIKE', "%{$query}%")
        ->orWhere('email', 'LIKE', "%{$query}%")
        ->orWhere('phone', 'LIKE', "%{$query}%")
        ->orWhere('employee', 'LIKE', "%{$query}%")
        ->get();

        // Search in Elevators table
        $elevators = Elevators::where('imagen', 'LIKE', "%{$query}%")
            ->orWhere('contrato', 'LIKE', "%{$query}%")
            ->orWhere('nombre', 'LIKE', "%{$query}%")
            ->orWhere('código', 'LIKE', "%{$query}%")
            ->orWhere('marca', 'LIKE', "%{$query}%")
            ->orWhere('client_id', 'LIKE', "%{$query}%")
            ->orWhere('fecha', 'LIKE', "%{$query}%")
            ->orWhere('garantizar', 'LIKE', "%{$query}%")
            ->orWhere('dirección', 'LIKE', "%{$query}%")
            ->orWhere('ubigeo', 'LIKE', "%{$query}%")
            ->orWhere('provincia', 'LIKE', "%{$query}%")
            ->orWhere('técnico_instalador', 'LIKE', "%{$query}%")
            ->orWhere('técnico_ajustador', 'LIKE', "%{$query}%")
            ->orWhere('tipo_de_ascensor', 'LIKE', "%{$query}%")
            ->orWhere('cantidad', 'LIKE', "%{$query}%")
            ->orWhere('quarters', 'LIKE', "%{$query}%")
            ->orWhere('npisos', 'LIKE', "%{$query}%")
            ->orWhere('ncontacto', 'LIKE', "%{$query}%")
            ->orWhere('teléfono', 'LIKE', "%{$query}%")
            ->orWhere('correo', 'LIKE', "%{$query}%")
            ->orWhere('descripcion1', 'LIKE', "%{$query}%")
            ->get();

        // Elevator Type
        // $reviewType = ReviewType::whereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$query}%"])->get();
        $elevatorsType = Elevatortypes::where('nombre_de_tipo_de_ascensor', 'LIKE', "%{$query}%")->get();




        // Search in Marca table
        $marcas = Marca::where('marca_nombre', 'LIKE', "%{$query}%")
            ->get();

        // Search in SparePart table
        $spareParts = SparePart::where('foto_de_repuesto', 'LIKE', "%{$query}%")
            ->orWhere('nombre', 'LIKE', "%{$query}%")
            ->orWhere('precio', 'LIKE', "%{$query}%")
            ->orWhere('descripción', 'LIKE', "%{$query}%")
            ->orWhere('frecuencia_de_limpieza', 'LIKE', "%{$query}%")
            ->orWhere('frecuencia_de_lubricación', 'LIKE', "%{$query}%")
            ->orWhere('frecuencia_de_ajuste', 'LIKE', "%{$query}%")
            ->orWhere('frecuencia_de_revisión', 'LIKE', "%{$query}%")
            ->orWhere('frecuencia_de_cambio', 'LIKE', "%{$query}%")
            ->orWhere('frecuencia_de_solicitud', 'LIKE', "%{$query}%")
            ->get();
        return view('search.results', compact('assignSpares', 'clientes', 'contracts','customerTypes','maininReview','positions','province','reviewType','staff','users', 'elevators', 'elevatorsType', 'marcas', 'spareParts'));
    }
}
