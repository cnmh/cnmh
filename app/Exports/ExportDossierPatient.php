<?php

namespace App\Exports;

use App\Models\DossierPatient;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Tuteur;
use App\Models\Patient;
use App\Models\NiveauScolaire;
use App\Models\EtatCivil;





use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportDossierPatient implements WithMultipleSheets
{


    public function sheets(): array
    {
        return [
            'Tuteur' => new class implements FromQuery, WithTitle, WithHeadings {
                public function query()
                {
                    return Tuteur::select('id', 'etat_civil_id', 'nom', 'prenom', 'sexe', 'telephone', 'email', 'adresse', 'cin', 'remarques');
                }
            
                public function headings(): array
                {
                    return ['Id', 'Etat Civil Id', 'Nom', 'Prenom', 'Sexe', 'Telephone', 'Email', 'Adresse', 'CIN', 'Remarques'];
                }
            
                public function title(): string
                {
                    return 'Tuteur';
                }
            },
            
            'Patient' => new class implements FromQuery, WithTitle, WithHeadings {
                public function query()
                {
                    return Patient::select('id', 'tuteur_id', 'niveau_scolaire_id', 'nom', 'prenom', 'telephone', 'cin', 'email', 'adresse', 'remarques');
                }
            
                public function headings(): array
                {
                    return ['Id', 'Tuteur Id', 'Niveau Scolaire Id', 'Nom', 'Prenom', 'Telephone', 'CIN', 'Email', 'Adresse', 'Remarques'];
                }
            
                public function title(): string
                {
                    return 'Patient';
                }
            },
            
            'DossierPatient' => new class implements FromQuery, WithTitle, WithHeadings {
                public function query()
                {
                    return DossierPatient::select('id', 'patient_id', 'couverture_medical_id', 'numero_dossier', 'etat', 'date_enregsitrement', 'user_id');
                }
            
                public function headings(): array
                {
                    return ['Id', 'Patient Id', 'Couverture Medical Id', 'Numero Dossier', 'Etat', 'Date Enregistrement', 'User Id'];
                }
            
                public function title(): string
                {
                    return 'DossierPatient';
                }
            },
            
            'NiveauScolaire' => new class implements FromQuery, WithTitle, WithHeadings {
                public function query()
                {
                    return NiveauScolaire::select('id', 'nom', 'description');
                }
            
                public function headings(): array
                {
                    return ['Id', 'Nom', 'Description'];
                }
            
                public function title(): string
                {
                    return 'NiveauScolaire';
                }
            },
            
            'EtatCivil' => new class implements FromQuery, WithTitle, WithHeadings {
                public function query()
                {
                    return EtatCivil::select('id', 'nom', 'description');
                }
            
                public function headings(): array
                {
                    return ['Id', 'Nom', 'Description'];
                }
            
                public function title(): string
                {
                    return 'EtatCivil';
                }
            },
            
        ];
    }

   }
