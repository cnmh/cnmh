<?php

namespace App\Exports;

use App\Models\Employe;
use App\Models\Fonction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportEmployes implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $fonction_referance_culomn = (new Fonction())->referance_culomn;
        $fonction_referance_culomn='nom';
        return
            $employe =  Employe::select(
                'employes.nom AS nom',
                'prenom',
                'email',
                'telephone',
                'adresse',
                'date_naissance',
                'cin',
                'date_embauche',
                'fonctions.'.$fonction_referance_culomn.' as fonction'
            )->join('fonctions', 'fonctions.id', '=', 'employes.fonction_id')
            ->get();
    }
    public function headings(): array
    {
        return [
            'Nom',
            'Prénom',
            'E-mail',
            'Téléphone',
            'Adresse',
            'Date de naissance',
            'CIN',
            "Date d'embauche",
            'Fonction'
        ];
    }
}
