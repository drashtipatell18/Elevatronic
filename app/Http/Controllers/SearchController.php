<?php

namespace App\Http\Controllers;

use App\Models\AssginSpare;
use App\Models\Cliente;
use App\Models\Contract;
use App\Models\Elevators;
use App\Models\Marca;
use App\Models\SparePart;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search in AssginSpare table
        $assignSpares = AssginSpare::where('nombre_del_tipo_de_ascensor', 'LIKE', "%{$query}%")
            ->orWhere('reemplazo', 'LIKE', "%{$query}%")
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

        // Search in Elevators table
        $elevators = Elevators::where('imagen', 'LIKE', "%{$query}%")
            ->orWhere('contrato', 'LIKE', "%{$query}%")
            ->orWhere('nombre', 'LIKE', "%{$query}%")
            ->orWhere('código', 'LIKE', "%{$query}%")
            ->orWhere('marca', 'LIKE', "%{$query}%")
            ->orWhere('cliente', 'LIKE', "%{$query}%")
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
        return view('search.results', compact('assignSpares', 'clientes', 'contracts', 'elevators', 'marcas', 'spareParts'));
    }
}
