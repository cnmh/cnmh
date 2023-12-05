<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\ImportTuteur;
use App\Imports\ImportPatient;
use App\Imports\ImportDossierPatient;

class ImportDossierPatientGlobal implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Tuteur' => new ImportTuteur(),
            'Patient' => new ImportPatient(new ImportTuteur()),
        ];
    }
}