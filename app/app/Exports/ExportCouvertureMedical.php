<?php

namespace App\Exports;

use App\Models\couvertureMedical;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExportCouvertureMedical implements FromCollection,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        // Remove HTML tags from the description field
        $couvertureMedicals = couvertureMedical::select("nom","description")->get();
        $couvertureMedicals->transform(function ($couvertureMedical) {
          $couvertureMedical->description = strip_tags($couvertureMedical->description);
          return $couvertureMedical;
        });
        return $couvertureMedicals;
    }
    public function headings(): array
    {
        return [ "Nom", "Description"];
    }
    public function title(): string
    {
        return 'couverture medical';
    }
}
