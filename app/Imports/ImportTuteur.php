<?php

namespace App\Imports;

use App\Models\Tuteur;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportTuteur implements ToModel
{
    public function model(array $row)
    {
        if ($row[0] === 'Etat Civil Id') {
            return null;
        }

        $tuteur = Tuteur::create([
            'etat_civil_id' => $row[0],
            'nom' => $row[1],
            'prenom' => $row[2],
            'sexe' => $row[3],
            'telephone' => $row[4],
            'email' => $row[5],
            'adresse' => $row[6],
            'cin' => $row[7],
            'remarques' => $row[8],
        ]);

        return $tuteur;
    }
}
