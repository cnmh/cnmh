<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\DossierPatient;
use Illuminate\Database\Seeder;
use App\Models\CouvertureMedical;

// avoir un problème typographique dans la colonne "romarque" du tableau DossierPatientsTable

/**
 * Class DossierPatientsTableSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */


class DossierPatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $now = \Carbon\Carbon::now();
    
            $dossierPatient = DossierPatient::insert([
                [
    
                    'user_id'=> User::inRandomOrder()->first()->id,
                    'couverture_medical_id'=> CouvertureMedical::inRandomOrder()->first()->id,
                    'patient_id'=>Patient::inRandomOrder()->first()->id,
    
                    'numero_dossier'=>'A1802',
                    'etat'=>'entretien social',
                    'date_enregsitrement'=>'2023-07-1',
                    'romarque'=>'remarques de dossier patient',
                    'created_at'=> $now,
                    'updated_at'=>$now
                ],
                [
    
                    'user_id'=> User::inRandomOrder()->first()->id,
                    'couverture_medical_id'=> CouvertureMedical::inRandomOrder()->first()->id,
                    'patient_id'=>Patient::inRandomOrder()->first()->id,
    
                    'numero_dossier'=>'A1803',
                    'etat'=>'entretien social',
                    'date_enregsitrement'=>'2023-07-1',
                    'romarque'=>'remarques de dossier patient',
                    'created_at'=> $now,
                    'updated_at'=>$now
                ],
                [
    
                    'user_id'=> User::inRandomOrder()->first()->id,
                    'couverture_medical_id'=> CouvertureMedical::inRandomOrder()->first()->id,
                    'patient_id'=>Patient::inRandomOrder()->first()->id,
                    'numero_dossier'=>'A1804',
                    'etat'=>'entretien social',
                    'date_enregsitrement'=>'2023-07-1',
                    'romarque'=>'remarques de dossier patient',
                    'created_at'=> $now,
                    'updated_at'=>$now
                ]
    
            ]);
    
    }
}
