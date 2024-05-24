<?php namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\MaintInReview;

class MaintInReviewImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
           $main =  MaintInReview::create([
                'tipo_de_revisión' => $row[0],
                'ascensor' => $row[1],
                'dirección' => $row[2],
                'provincia' => $row[3],
                'núm_certificado' => $row[4],
                'máquina' => $row[5],
                'supervisor' => $row[6],
                'técnico' => $row[7],
                'mes_programado' => $row[8],
                'fecha_de_mantenimiento' => $row[9],
                'hora_inicio' => $row[10],
                'hora_fin' => $row[11],
                'observaciónes' => $row[12],
                'observaciónes_internas' => $row[13],
                'solución' => $row[14],
            ]);
        }
        echo '<pre>';
        print_r($main);
        echo '</pre>';exit;
    }
}

