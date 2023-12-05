<?php

namespace App\Imports;

use App\Models\CouvertureMedical;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportCouvertureMedical implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   
    public $headingRow = null;

    public function model(array $row)
    {
        $couvertureMedical = CouvertureMedical::firstOrNew(['nom' => $row[0]]);
        
        $couvertureMedical->description = $row[1];

        $couvertureMedical->save();

        return $couvertureMedical;
    }
    public function startRow():int{
        return 2;
    }
}
