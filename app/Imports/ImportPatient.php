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

        $rules = [
            'niveau_scolaire_id' => 'nullable',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'image' => 'nullable|file|max:255',
            'adresse' => 'nullable|string|max:255',
            'remarques' => 'nullable|string|max:65535',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ];

        $validator = \Validator::make($row, $rules);

        $tuteurId = $this->importTuteur->model($row);

        if (!$tuteurId) {
            return null;
        }

        Patient::create([
            'tuteur_id' => $tuteurId,
            'niveau_scolaire_id' => $row[2],
            'nom' => $row[3],
            'prenom' => $row[4],
            'telephone' => $row[5],
            'cin' => $row[6],
            'email' => $row[7],
            'image' => null,
            'adresse' => $row[8],
            'remarques' => $row[9],
        ]);
    }
}
