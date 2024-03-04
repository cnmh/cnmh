<?php

namespace App\Exports;

use App\Models\fonction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportFonction implements FromCollection,WithHeadings
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