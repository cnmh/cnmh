<?php

namespace Database\Seeders;

use App\Models\TypeHandicap;
use App\Models\DossierPatient;
use Illuminate\Database\Seeder;
use App\Models\DossierPatient_typeHandycape;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


/**
 * Class DossierPatientTypeHandicapSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */


class DossierPatientTypeHandicapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dossierPatients = DossierPatient::all();
        $typeHandicaps = TypeHandicap::all();

        foreach ($dossierPatients as $dossierPatient) {
            $randomTypeHandicap = $typeHandicaps->random();

            DossierPatient_typeHandycape::insert([
                'dossier_patient_id' => $dossierPatient->id,
                'type_handicap_id' => $randomTypeHandicap->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


