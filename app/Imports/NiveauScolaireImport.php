<?php

namespace App\Imports;

use App\Models\NiveauScolaire;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class NiveauScolaireImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $headingRow = null;

    public function model(array $row)
    {
        $niveauScolaire = NiveauScolaire::firstOrNew(['nom' => $row[0]]);
        
        $niveauScolaire->description = $row[1];

        $niveauScolaire->save();

        return $niveauScolaire;
    }

    public function startRow():int{
        return 2;
    }
}
