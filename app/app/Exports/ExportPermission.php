<?php

namespace App\Exports;

use App\Models\permission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPermission implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Permission::select(
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