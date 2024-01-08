<?php

namespace Database\Seeders\Social;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Dossier_patient_service;

class DossierPatientServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();
        $dossierPatientservice = Dossier_patient_service::insert([
            [
                'dossier_patient_id' => 1,
                'service_id' => Service::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 2,
                'service_id' => Service::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 3,
                'service_id' => Service::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 4,
                'service_id' => Service::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 5,
                'service_id' => Service::inRandomOrder()->first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
           
           
        ]);
    }
}
