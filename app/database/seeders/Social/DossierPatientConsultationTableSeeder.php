<?php

namespace Database\Seeders\Social;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DossierPatientConsultation;

class DossierPatientConsultationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();
        $dossierPatientConsultation = DossierPatientConsultation::insert([
            [
                'dossier_patient_id' => 1,
                'consultation_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id' => 2,
                'consultation_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],  [
                'dossier_patient_id' => 3,
                'consultation_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],  [
                'dossier_patient_id' => 4,
                'consultation_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],  [
                'dossier_patient_id' => 5,
                'consultation_id' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
