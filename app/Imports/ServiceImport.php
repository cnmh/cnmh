<?php

namespace App\Imports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ServiceImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $headingRow = null;

    public function model(array $row)
    {
        $service = Service::firstOrNew(['nom' => $row[0]]);
        
        $service->description = $row[1];

        $service->save();

        return $service;
    }
    public function startRow():int{
        return 2;
    }
}
