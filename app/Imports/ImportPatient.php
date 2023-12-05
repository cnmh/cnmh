<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Patient;

class ImportPatient implements ToCollection
{
    protected $tuteurId;

    public function __construct($tuteurId)
    {
        $this->tuteurId = $tuteurId;
    }

    public function collection(Collection $rows)
    {
        $rows = $rows->slice(1);

        foreach ($rows as $cells) {
            if (count($cells) > 0) {
                Patient::create([
                    'tuteur_id' => $this->tuteurId,
                    'niveau_scolaire_id' => $cells[0],
                    'nom' => $cells[1],
                    'prenom' => $cells[2],
                    'telephone' => $cells[3],
                    'cin' => $cells[4],
                    'email' => $cells[5],
                    'image' => null,
                    'adresse' => $cells[6],
                    'remarques' => $cells[7],
                ]);
            }
        }
    }
}
