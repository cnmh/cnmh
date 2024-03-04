<?php

namespace Database\Seeders;


use App\Models\Employe;
use App\Models\Fonction;
use App\Models\EtatCivil;
use App\Models\NiveauScolaire;
use App\Models\Service;
use App\Models\TypeHandicap;
use App\Models\CouvertureMedical;

use Illuminate\Database\Seeder;

class ParamaitresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        // Employes initial data

        $employe = Employe::insert([
            [
                'nom' => ' souan',
                'prenom'=>'Khawla',
                'email'=>'khawla@gmail.com',
                'telephone'=>'0600000001',
                'adresse'=>'tanger',
                'date_naissance'=>'1998-12-11',
                'cin'=>'K00001',
                'fonction_id'=>Fonction::inRandomOrder()->first()->id,
                'date_embauche'=>'2020-12-11',
                'created_at'=> $now,
                'updated_at'=>$now
            ]

        ]);

        // Etat civil initial data

        $etat_civil = EtatCivil::insert([
            [
                'nom' => 'Marié(e)',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Divorcé(e)',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Célibataire',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Veuf(ve)',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

        // NiveauScolaire initial data

        $niveauScholaire = NiveauScolaire::insert([
            [
                'nom' => 'Maternelle',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Ecole primaire',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Collége',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Lycéé',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Université',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // Service initial data

        $service = Service::insert([
            [
                'nom' => 'Service social',
                'description' => 'description prestation 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Service médical',
                'description' => 'description prestation 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Service Éducatif',
                'description' => 'description prestation 3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Service de la Formation Professionnelle',
                'description' => 'description prestation 4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Service sportif',
                'description' => 'description prestation 5',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

         // TypeHandicap initial data
        
        $typehandicap = TypeHandicap::insert([
            [
                'nom' => 'TSA V2',
                'description' => 'description type handicap 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'RETARD MENTAL',
                'description' => 'description type handicap 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'TRISOMIE 21',
                'description' => 'description type handicap 3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'IMC',
                'description' => 'description type handicap 4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'RPM',
                'description' => 'description type handicap 5',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'RETARD DE LANGUAGE',
                'description' => ' description type handicap 6',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'HANDICAP MOTEUR',
                'description' => 'description type handicap 7',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'AUTRES',
                'description' => 'description type handicap 8',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

        // couvertureMedical initial data

        $couvertureMedicals = CouvertureMedical::insert([
            [
                'nom' => 'cnops',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'cnss',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'FAR',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'assurance (complimentaire)',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Ne sait pas',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);


    }
}
