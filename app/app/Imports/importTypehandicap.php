<?php

namespace App\Imports;

use App\Models\TypeHandicap;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class importTypehandicap implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $headingRow = null;

    public function model(array $row)
    {
       $typeHandicap = TypeHandicap::firstOrNew(['nom' => $row[0]]);

       $typeHandicap->description = $row[1];

       $typeHandicap->save();

       return $typeHandicap;
    }

    public function startRow():int{
        return 2;
    }
}
