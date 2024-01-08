<?php

namespace Database\Seeders\Social;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeHandicap;
use App\Models\DossierPatient_typeHandycape;


class DossierPatientTypeHandicapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();
        $dossierPatientTypeHandicap = DossierPatient_typeHandycape::insert([
            [
                'dossier_patient_id' => 1,
                'type_handicap_id' => TypeHandicap::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 2,
                'type_handicap_id' => TypeHandicap::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 3,
                'type_handicap_id' => TypeHandicap::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 4,
                'type_handicap_id' => TypeHandicap::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 5,
                'type_handicap_id' => TypeHandicap::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
           
        ]);
    }
}
