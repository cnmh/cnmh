<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\DossierPatient;
use Illuminate\Database\Seeder;
use App\Models\Dossier_patient_service;

/**
 * Class DossierPatientServiceSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */



class DossierPatientServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();

        // Retrieve all unique DossierPatient records
        $uniqueDossierPatients = DossierPatient::inRandomOrder()->distinct()->get(['id']);

        // dd(Service::inRandomOrder()->first()->id); 
        foreach ($uniqueDossierPatients as $dossierPatient) {
            Dossier_patient_service::insert([
                'dossier_patient_id' =>  $dossierPatient->id, 
                'service_id' => 1, 
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        
        // $DossierPatientService = Dossier_patient_service::insert([
        //     [
        //         'dossier_patient_id' =>  $uniqueDossierPatients->shift()->id, 
        //         'service_id' => Service::inRandomOrder()->first()->id, 
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        //     [
        //         'dossier_patient_id' => $uniqueDossierPatients->shift()->id, 
        //         'service_id' => Service::inRandomOrder()->first()->id,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        //     [
        //         'dossier_patient_id' => $uniqueDossierPatients->shift()->id, 
        //         'service_id' => Service::inRandomOrder()->first()->id,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        // ]);
    }
}


