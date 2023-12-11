<?php

namespace App\Imports;

use App\Models\EtatCivil;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportEtatCivil implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $headingRow = null;

    public function model(array $row)
    {
       $etatCivil = EtatCivil::firstOrNew(['nom' => $row[0]]);

       $etatCivil->description = $row[1];

       $etatCivil->save();

       return $etatCivil;
    }

    public function startRow():int{
        return 2;
    }
}
