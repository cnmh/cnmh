<?php

namespace App\Imports;

use App\Models\Consultation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportConsultation implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $consultation = Consultation::where('id', $row['id'])->first();

        if ($consultation) {
            $consultation->update([
                'date_enregistrement' => $row['date_enregistrement'],
                'date_consultation' => $row['date_consultation'],
                'observation' => $row['observation'],
                'diagnostic' => $row['diagnostic'],
                'bilan' => $row['bilan'],
                'type' => $row['type'],
                'etat' => $row['etat'],
            ]);
        }

        return $consultation;
    }
}