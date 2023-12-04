<?php

namespace App\Imports;

use App\Models\Tuteur;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportTuteur implements ToModel
{

    public function model(array $row)
    {
        if ($row[0] === 'Id') {
            return null;
        }

        Tuteur::create([
            'id' => $row[0],
            'etat_civil_id' => $row[1],
            'nom' => $row[2],
            'prenom' => $row[3],
            'sexe' => $row[4],
            'telephone' => $row[5],
            'email' => $row[6],
            'adresse' => $row[7],
            'cin' => $row[8],
            'remarques' => $row[9],
        ]);


    }
}