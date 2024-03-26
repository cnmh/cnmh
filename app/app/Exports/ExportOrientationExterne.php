<?php

namespace App\Exports;

use App\Models\orientationExterne;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportOrientationExterne implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return couvertureMedical::select("id")->get();
    }
    public function headings(): array
    {
        return [ "Id"];
    }
}