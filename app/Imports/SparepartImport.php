<?php namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Sparepart;

class SparepartImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Sparepart::create([
                'nombre' => $row[0],
                'precio' => $row[1],
            ]);
        }
    }
}
