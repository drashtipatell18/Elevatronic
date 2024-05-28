<?php namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\MaintInReview;
use Carbon\Carbon;

class MaintReviewImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
            // Convert Excel date serial number to a valid date format
            $fecha_de_mantenimiento = $this->convertToDate($row[3]);
            
            MaintInReview::create([
                'tipo_de_revisión' => $row[0] ?? null,
                'ascensor' => $row[1] ?? null,
                'núm_certificado' => $row[2] ?? null,
                'fecha_de_mantenimiento' => $fecha_de_mantenimiento,
                'hora_inicio' => $row[4] ?? null,
                'hora_fin' => $row[5] ?? null,
                'técnico' => $row[6] ?? null,
                'observaciónes' => $row[7] ?? null,
            ]);
             } catch (\Exception $e) {
                \Log::error('Failed to insert row: ' . $e->getMessage());
            }
        }
    }

    private function convertToDate($value)
    {
        // Check if the value is an Excel date serial number
        if (is_numeric($value)) {
            // Convert Excel date serial number to a valid date
            return Carbon::createFromFormat('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d'));
        }
        // Return the original value if it's not an Excel date serial number
        return $value;
    }
}


// namespace App\Imports;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
// use App\Models\MaintInReview;
// use Carbon\Carbon;

// class MaintReviewImport implements ToCollection
// {
//     public function collection(Collection $rows)
//     {
//         foreach ($rows as $index => $row) {
//             // Skip header row
//             if ($index === 0) {
//                 continue;
//             }

//             // Check if any required columns are empty
//             if (!$this->isValidRow($row)) {
//                 \Log::warning('Skipping invalid row: ' . implode(',', $row));
//                 continue;
//             }

//             try {
//                 // Convert Excel date serial number to a valid date format
//                 $fecha_de_mantenimiento = $this->convertToDate($row[4]);
                
//                 MaintInReview::create([
//                     'id' => $row[0] ?? null,
//                     'tipo_de_revisión' => $row[1] ?? null,
//                     'ascensor' => $row[2] ?? null,
//                     'núm_certificado' => $row[3] ?? null,
//                     'fecha_de_mantenimiento' => $fecha_de_mantenimiento,
//                     'hora_inicio' => $row[5] ?? null,
//                     'hora_fin' => $row[6] ?? null,
//                     'técnico' => $row[7] ?? null,
//                     'observaciónes' => $row[8] ?? null,
//                 ]);
//             } catch (\Exception $e) {
//                 \Log::error('Failed to insert row: ' . $e->getMessage());
//             }
//         }
//     }

//     private function convertToDate($value)
//     {
//         // Check if the value is an Excel date serial number
//         if (is_numeric($value)) {
//             // Convert Excel date serial number to a valid date
//             return Carbon::createFromFormat('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d'));
//         }
//         // Return the original value if it's not an Excel date serial number
//         return $value;
//     }

//     private function isValidRow($row)
//     {
//         // Check if any required columns are empty
//         return !empty($row[1]) && !empty($row[2]) && !empty($row[4]) && !empty($row[7]);
//     }
// }
