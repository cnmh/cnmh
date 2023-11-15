<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\DossierPatient;
use Illuminate\Database\Seeder;
use App\Models\OrientationExterne;

class OrientationExternesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $OrientationExt = OrientationExterne::insert([
            [
                'dossier_patient_id'=>DossierPatient::inRandomOrder()->first()->id,
        'service_id'=>Service::inRandomOrder()->first()->id,
        'objet'=>"Manque d'un photo copier de cin",
        'description'=>"Description orientation externe 1",
        'date_orientation'=>"2023-06-20",

                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'dossier_patient_id'=>DossierPatient::inRandomOrder()->first()->id,
                'service_id'=>Service::inRandomOrder()->first()->id,
                'objet'=>"Il manque un document administratif.",
                'description'=>"Description orientation externe 2",
                'date_orientation'=>"2023-06-21",

                        'created_at' => $now,
                        'updated_at' => $now,
            ],


        ]);
    }
}
