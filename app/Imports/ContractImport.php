<?php namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Contract;

class ContractImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if ($key === 0) {
                continue; // Skip header row
            }
            try {
                // Validate date format before creating DateTime
                $fechaPropuesta = $this->validateDate($row[1]);
                $fechaInicio = $this->validateDate($row[3]);
                $fechaFin = $this->validateDate($row[4]);

                $contract = Contract::create([
                    'ascensor' => $row[0],
                    'fecha_de_propuesta' => $fechaPropuesta,
                    'monto_de_propuesta' => $row[2],
                    'fecha_de_inicio' => $fechaInicio,
                    'fecha_de_fin' => $fechaFin,
                    'monto_de_contrato' => $row[5],
                    'estado' => $row[6],
                ]);
            } catch (\Exception $e) {
                // Log the error message and the row that caused it
                \Log::error('Failed to import row: ' . json_encode($row) . ' - Error: ' . $e->getMessage());
            }
        }
    }

    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date ? $d->format($format) : null; // Return null if invalid
    }
}