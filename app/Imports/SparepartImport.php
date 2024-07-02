<?php namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Sparepart;

class SparepartImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if ($key === 0) {
                continue;
            }
            Sparepart::create([
                'nombre' => $row[0],
                'precio' => $row[1],
                'frecuencia_de_limpieza' => $row[2],
                'frecuencia_de_lubricación' =>  $row[3],
                'frecuencia_de_ajuste'  => $row[4],
                'frecuencia_de_revisión' => $row[5],
                'frecuencia_de_cambio'  => $row[6],
                'frecuencia_de_solicitud' => $row[7],
            ]);
        }
    }
}
