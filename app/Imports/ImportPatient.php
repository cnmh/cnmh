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
        if ($row[0] === 'Niveau Scolaire Id') {
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

        if ($validator->fails()) {
            return null;
        }

        $tuteur = $this->importTuteur->model($row);

        if ($tuteur === null) {
            return null;
        }

        Patient::create([
            'tuteur_id' => $tuteur->id,
            'niveau_scolaire_id' => $row[0],
            'nom' => $row[1],
            'prenom' => $row[2],
            'telephone' => $row[3],
            'cin' => $row[4],
            'email' => $row[5],
            'image' => null,
            'adresse' => $row[6],
            'remarques' => $row[7],
        ]);

        return $tuteur;
    }
}