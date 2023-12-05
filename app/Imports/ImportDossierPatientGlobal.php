<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

use App\Models\Tuteur;
use App\Models\Patient;

class ImportDossierPatientGlobal implements WithMultipleSheets
{
    private $tuteurId;

    public function sheets(): array
    {
        $importTuteur = new ImportTuteur();
        $importPatient = new ImportPatient();

        return [
            'Tuteur' => $importTuteur,
            'Patient' => $importPatient,
        ];
    }

    public function setTuteurId($tuteurId)
    {
        $this->tuteurId = $tuteurId;
    }
}

class ImportTuteur implements ToCollection,WithStartRow
{
    public $headingRow = null;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $emailTuteur = $row[5];
            $tuteur = Tuteur::where('email', $emailTuteur)->first();

            if (!$tuteur) {
                $tuteur = new Tuteur;
                $tuteur->etat_civil_id = $row[0];
                $tuteur->nom = $row[1];
                $tuteur->prenom = $row[2];
                $tuteur->sexe = $row[3];
                $tuteur->telephone = $row[4];
                $tuteur->email = $row[5];
                $tuteur->adresse = $row[6];
                $tuteur->cin = $row[7];
                $tuteur->remarques = $row[8];

                if (!$tuteur->save()) {
                    $errors = $tuteur->getErrors();
                }
            }

            if (!is_null($tuteur->id)) {
                $importPatient = new ImportPatient();
                $importPatient->setTuteurId($tuteur->id);
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}

class ImportPatient implements ToCollection,WithStartRow
{
    private $tuteurId;

    public function setTuteurId($tuteurId)
    {
        $this->tuteurId = $tuteurId;
    }

    public $headingRow = null;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $namePatient = $row[1];
            $prenomPatient = $row[2];

            $patient = Patient::where('nom', $namePatient)->where('prenom', $prenomPatient)->first();

            if (!$patient) {
                $patient = new Patient;
                $patient->tuteur_id = $this->tuteurId;
                $patient->niveau_scolaire_id = $row[0];
                $patient->nom = $row[1];
                $patient->prenom = $row[2];
                $patient->telephone = $row[3];
                $patient->cin = $row[4];
                $patient->email = $row[5];
                $patient->image = null;
                $patient->adresse = $row[6];
                $patient->remarques = $row[7];

                if (!$patient->save()) {
                    $errors = $patient->getErrors();
                }
            }
        }
    }

     public function startRow(): int
    {
        return 2;
    }
}