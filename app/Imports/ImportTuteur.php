<?php

namespace App\Imports;

use App\Models\Tuteur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportTuteur implements ToModel
{
    private $tuteurs = [];

    public function model(array $row)
    {
        if ($row[0] === 'Id') {
            return null;
        }

        $tuteur = Tuteur::create([
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

        $this->tuteurs[$tuteur->id] = $tuteur;

        return $tuteur;
    }

    public function getTuteurs(): Collection
    {
        return collect($this->tuteurs);
    }
}
