<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\ImportTuteur;
use App\Imports\ImportPatient;

class ImportDossierPatientGlobal implements WithMultipleSheets
{
    private $tuteurId;

    public function sheets(): array
    {
        return [
            'Tuteur' => new ImportTuteur($this),
            'Patient' => new ImportPatient($this->tuteurId),
        ];
    }

    public function setTuteurId($tuteurId)
    {
        $this->tuteurId = $tuteurId;
    }
}