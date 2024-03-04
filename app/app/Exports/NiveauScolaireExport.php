<?php

namespace App\Exports;

use App\Models\NiveauScolaire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class NiveauScolaireExport implements FromCollection , WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $niveauScolaires= NiveauScolaire::select("nom", "description")->get();

        // Remove HTML tags from the description field
        $niveauScolaires->transform(function ($niveauScolaires) {
            $niveauScolaires->description = strip_tags($niveauScolaires->description);
            return $niveauScolaires;
        });

        return $niveauScolaires;
    }
    public function headings(): array
    {
        return ["Nom", "Description"];
    }

    public function title(): string
    {
        return 'Niveau Scolaire';
    }
}
