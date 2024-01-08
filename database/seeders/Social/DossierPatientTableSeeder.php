<?php

namespace Database\Seeders\Social;

use App\Models\DossierPatient;
use App\Models\Patient;
use App\Models\CouvertureMedical;
use App\Models\User;




use Illuminate\Database\Seeder;

class DossierPatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        // $latestDossier = DossierPatient::where('numero_dossier', 'like', 'A-%')
        // ->whereRaw('CAST(SUBSTRING(numero_dossier, 3) AS SIGNED) IS NOT NULL')
        // ->max('numero_dossier');

        // $counter = $latestDossier ? (int)substr($latestDossier, 2) + 1 : 1802;

        // $numeroDossier = 'A-' . $counter;

        $user = User::where('email','social@gmail.com')->first();


        $dossierPatient = DossierPatient::insert([
            [
                'patient_id' => 1,
                'couverture_medical_id' => CouvertureMedical::inRandomOrder()->first()->id,
                'numero_dossier' => 'A-1802',
                'etat'=>'enAttente',
                'date_enregsitrement'=> $now,
                'romarque'=> null,
                'user_id'=> $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'patient_id' => 2,
                'couverture_medical_id' => CouvertureMedical::inRandomOrder()->first()->id,
                'numero_dossier' => 'A-1803',
                'etat'=>'enAttente',
                'date_enregsitrement'=> $now,
                'romarque'=> null,
                'user_id'=> $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'patient_id' => 3,
                'couverture_medical_id' => CouvertureMedical::inRandomOrder()->first()->id,
                'numero_dossier' => 'A-1804',
                'etat'=>'enAttente',
                'date_enregsitrement'=> $now,
                'romarque'=> null,
                'user_id'=> $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'patient_id' => 4,
                'couverture_medical_id' => CouvertureMedical::inRandomOrder()->first()->id,
                'numero_dossier' => 'A-1805',
                'etat'=>'enAttente',
                'date_enregsitrement'=> $now,
                'romarque'=> null,
                'user_id'=> $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'patient_id' => 5,
                'couverture_medical_id' => CouvertureMedical::inRandomOrder()->first()->id,
                'numero_dossier' => 'A-1806',
                'etat'=>'enAttente',
                'date_enregsitrement'=> $now,
                'romarque'=> null,
                'user_id'=> $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
           

        ]);

    }
}
