<?php

namespace App\Imports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPatient implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row[0] === 'Id') {
            return null;
        }

        return new Patient([
            'id' => $row[0],
            'tuteur_id' => $row[1],
            'niveau_scolaire_id' => $row[2],
            'nom' => $row[3],
            'prenom' => $row[4],
            'telephone' => $row[5],
            'cin' => $row[6],
            'email' => $row[7],
            'adresse' => $row[8],
            'remarques' => $row[9],
        ]);
    }
}
