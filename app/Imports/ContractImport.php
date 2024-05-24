<?php namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Contract;

class ContractImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Contract::create([
                'ascensor' => $row[0],
                'fecha_de_propuesta' => $row[1],
                'monto_de_propuesta' => $row[2],
                'monto_de_contrato' => $row[3],
                'fecha_de_inicio' => $row[4],
                'fecha_de_fin' => $row[5],
                'cada_cuantos_meses' => $row[6],
                'observación' => $row[7],
                'estado_cuenta_del_contrato' => $row[8],
                'estado' => $row[10],
            ]);
        }
    }
}
