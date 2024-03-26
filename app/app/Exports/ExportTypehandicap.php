<?php

namespace App\Exports;

use App\Models\TypeHandicap;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportTypehandicap implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TypeHandicap::select(
            'nom',
            'description'
        )->get();
    }
    public function headings(): array
    {
        return [
        'Nom',
        'Description'
    ];
    }
    
}
