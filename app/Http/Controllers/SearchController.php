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
        $escapedQuery = str_replace(['%', '_'], ['\%', '\_'], $query);

        // Search in AssginSpare table
        $assignSpares = AssginSpare::where('nombre_del_tipo_de_ascensor', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('repuesto_id', 'LIKE', "%{$escapedQuery}%")
            ->get();

        // Search in Cliente table
        $clientes = Cliente::where('nombre', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('tipo_de_cliente', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('ruc', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('país', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('provincia', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('dirección', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('teléfono', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('teléfono_móvil', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('correo_electrónico', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('nombre_del_contacto', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('posición', 'LIKE', "%{$escapedQuery}%")
            ->get();

        // Search in Contract table
        $contracts = Contract::where('ascensor', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('fecha_de_propuesta', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('monto_de_propuesta', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('monto_de_contrato', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('fecha_de_inicio', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('fecha_de_fin', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('renovación', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('cada_cuantos_meses', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('observación', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('estado_cuenta_del_contrato', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('estado', 'LIKE', "%{$escapedQuery}%")
            ->get();

        // Search in Custimer Type table
        $customerTypes = CustomerType::where('tipo_de_client', 'LIKE', "%{$escapedQuery}%")->get();


        // MaintinRevieew search table
        $maininReview = MaintInReview::where('tipo_de_revisión', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('ascensor', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('dirección', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('provincia', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('supervisor', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('técnico', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('mes_programado', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('fecha_de_mantenimiento', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('hora_inicio', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('hora_fin', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('observaciónes', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('observaciónes_internas', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('solución', 'LIKE', "%{$escapedQuery}%")
        ->get();

        //Position table search
        $positions = Position::where('position', 'LIKE', "%{$escapedQuery}%")->get();

        //Province table search
        $province = Province::where('provincia', 'LIKE', "%{$escapedQuery}%")->get();

        // Review type search
        $reviewType = ReviewType::whereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$escapedQuery}%"])->get();
        // Staff Search table
        $staff = Staff::where('personalfoto', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('nombre', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('posición_id', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('correo', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('teléfono', 'LIKE', "%{$escapedQuery}%")
        ->get();


        // User search
        $users = User::where('username', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('name', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('email', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('phone', 'LIKE', "%{$escapedQuery}%")
        ->orWhere('employee_id', 'LIKE', "%{$escapedQuery}%")
        ->get();

        // Search in Elevators table
        $elevators = Elevators::where('imagen', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('contrato', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('nombre', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('código', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('marca', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('client_id', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('fecha', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('garantizar', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('dirección', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('ubigeo', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('provincia', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('técnico_instalador', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('técnico_ajustador', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('tipo_de_ascensor', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('cantidad', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('quarters', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('npisos', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('ncontacto', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('teléfono', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('correo', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('descripcion1', 'LIKE', "%{$escapedQuery}%")
            ->get();

        // Elevator Type
        // $reviewType = ReviewType::whereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$query}%"])->get();
        $elevatorsType = Elevatortypes::where('nombre_de_tipo_de_ascensor', 'LIKE', "%{$escapedQuery}%")->get();




        // Search in Marca table
        $marcas = Marca::where('marca_nombre', 'LIKE', "%{$escapedQuery}%")
            ->get();

        // Search in SparePart table
        $spareParts = SparePart::where('foto_de_repuesto', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('nombre', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('precio', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('descripción', 'LIKE', "%{$query}%")
            ->orWhere('frecuencia_de_limpieza', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('frecuencia_de_lubricación', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('frecuencia_de_ajuste', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('frecuencia_de_revisión', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('frecuencia_de_cambio', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('frecuencia_de_solicitud', 'LIKE', "%{$escapedQuery}%")
            ->get();
        return view('search.results', compact('assignSpares', 'clientes', 'contracts','customerTypes','maininReview','positions','province','reviewType','staff','users', 'elevators', 'elevatorsType', 'marcas', 'spareParts'));
    }
}
