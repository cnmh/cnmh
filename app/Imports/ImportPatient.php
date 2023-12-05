<?php

namespace App\Imports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPatient implements ToModel
{
    private $importTuteur;

    public function __construct(ImportTuteur $importTuteur)
    {
        $this->importTuteur = $importTuteur;
    }

    public function model(array $row)
    {
        if ($row[0] === 'Id') {
            return null;
        }

        $tuteurId = $row[1];

        $tuteurs = $this->importTuteur->getTuteurs();

        if (!isset($tuteurs[$tuteurId])) {
            return null;
        }

        dd($tuteurId);

        $tuteur = $tuteurs[$tuteurId];

        Patient::create([
            'tuteur_id' => $tuteur->id,
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
