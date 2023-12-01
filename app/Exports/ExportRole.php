<?php

namespace App\Exports;

use App\Models\Role;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportRole implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Role::select(
            'name',
            'guard_name'
        )->get();
    }
    public function headings(): array
    {
        return [
            'name',
            'guard_name'
    ];
    }
}