<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Tuteur;
use App\Models\Patient;
use App\Models\DossierPatient;

class ImportDossierPatient implements ToCollection
{
    private $tuteurData = [];
    private $patientData = [];
    private $dossierPatientData = [];

    public function collection($sheets)
    {
        $this->importTuteur($sheets[0]);
        $this->importPatient($sheets[1]);
        $this->importDossierPatient($sheets[2]);

    }
    private function importTuteur($dataRows)
    {
        foreach ($dataRows as $data) {
            $tuteurData = [
                'id' => $data[0] ?? null,
                'etat_civil_id' => $data[1] ?? null,
                'nom' => $data[2] ?? null,
                'prenom' => $data[3] ?? null,
                'sexe' => $data[4] ?? null,
                'telephone' => $data[5] ?? null,
                'email' => $data[6] ?? null,
                'adresse' => $data[7] ?? null,
                'cin' => $data[8] ?? null,
                'remarques' => $data[9] ?? null,
            ];
            // Tuteur::create($tuteurData);
        }
    }

    private function importPatient($dataRows)
    {
        foreach ($dataRows as $data) {
            $patientData = [
                'id' => $data[0] ?? null,
                'tuteur_id' => $data[1] ?? null,
                'niveau_scolaire_id' => $data[2] ?? null,
                'nom' => $data[3] ?? null,
                'prenom' => $data[4] ?? null,
                'telephone' => $data[5] ?? null,
                'cin' => $data[6] ?? null,
                'email' => $data[7] ?? null,
                'adresse' => $data[8] ?? null,
                'remarques' => $data[9] ?? null,
            ];


            // Patient::create($patientData);
        }
    }

    private function importDossierPatient($dataRows)
    {
        foreach ($dataRows as $data) {
            $dossierPatientData = [
                
            ];
            // DossierPatient::create($dossierPatientData);
        }
    }

}
