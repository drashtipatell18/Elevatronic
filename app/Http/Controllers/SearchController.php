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
        $assignSpares = AssginSpare::whereRaw('LOWER(nombre_del_tipo_de_ascensor) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(repuesto_id) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->get();

        // Search in Cliente table
        $clientes = Cliente::whereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(tipo_de_cliente) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(ruc) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(país) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(provincia) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(dirección) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(teléfono) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(teléfono_móvil) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(correo_electrónico) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(nombre_del_contacto) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(posición) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->get();

        // Search in Contract table
        $contracts = Contract::whereRaw('LOWER(ascensor) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(fecha_de_propuesta) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(monto_de_propuesta) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(monto_de_contrato) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(fecha_de_inicio) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(fecha_de_fin) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(renovación) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(cada_cuantos_meses) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(estado_cuenta_del_contrato) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(estado) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->get();

        // Search in Customer Type table
        $customerTypes = CustomerType::whereRaw('LOWER(tipo_de_client) LIKE LOWER(?)', ["%{$escapedQuery}%"])->get();

        // MaintinRevieew search table
        $maininReview = MaintInReview::whereRaw('LOWER(tipo_de_revisión) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(ascensor) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(dirección) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(provincia) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(supervisor_id) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(técnico) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(mes_programado) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(fecha_de_mantenimiento) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(hora_inicio) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(hora_fin) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(observaciónes) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(observaciónes_internas) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(solución) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->get();

        // Position table search
        $positions = Position::whereRaw('LOWER(position) LIKE LOWER(?)', ["%{$escapedQuery}%"])->get();

        // Province table search
        $province = Province::whereRaw('LOWER(provincia) LIKE LOWER(?)', ["%{$escapedQuery}%"])->get();

        // Review type search
        $reviewType = ReviewType::whereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$escapedQuery}%"])->get();

        // Staff Search table
        $staff = Staff::whereRaw('LOWER(personalfoto) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(posición_id) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(correo) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(teléfono) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->get();

        // User search
        $users = User::whereRaw('LOWER(username) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(name) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(email) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(phone) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(employee_id) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->get();

        // Search in Elevators table
        $elevators = Elevators::whereRaw('LOWER(imagen) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(código) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(marca_id) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(client_id) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(fecha) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(garantizar) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(dirección) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(ubigeo) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(provincia) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(técnico_instalador) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(técnico_ajustador) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(tipo_de_ascensor) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(cantidad) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(quarters) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(npisos) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(ncontacto) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(teléfono) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(correo) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(descripcion1) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->get();

        // Elevator Type
        $elevatorsType = Elevatortypes::whereRaw('LOWER(nombre_de_tipo_de_ascensor) LIKE LOWER(?)', ["%{$escapedQuery}%"])->get();

        // Search in Marca table
        $marcas = Marca::whereRaw('LOWER(marca_nombre) LIKE LOWER(?)', ["%{$escapedQuery}%"])->get();

        // Search in SparePart table
        $spareParts = SparePart::whereRaw('LOWER(foto_de_repuesto) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->orWhereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(precio) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(descripción) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(frecuencia_de_limpieza) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(frecuencia_de_lubricación) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(frecuencia_de_ajuste) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(frecuencia_de_revisión) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(frecuencia_de_cambio) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            // ->orWhereRaw('LOWER(frecuencia_de_solicitud) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->get();

        return view('search.results', compact('assignSpares', 'clientes', 'contracts', 'customerTypes', 'maininReview', 'positions', 'province', 'reviewType', 'staff', 'users', 'elevators', 'elevatorsType', 'marcas', 'spareParts'));
    }
}
