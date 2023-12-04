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
    /**
     * @param  Collection  $collection
     */
    public function sheets(): array
    {
        return [
            0 => new ImportTuteur(),
            1 => new ImportPatient(),
            2 => new ImportDossierPatient(),
        ];
    }
}

