<?php

namespace App\Exports;

use App\Models\EtatCivil;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportEtatCivil implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EtatCivil::all();
    }
}
