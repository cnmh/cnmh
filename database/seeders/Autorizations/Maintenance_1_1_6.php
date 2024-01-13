<?php

namespace Database\Seeders\Autorizations;

use App\Models\Service;
use Illuminate\Database\Seeder;

class Maintenance_1_1_6 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $ServiceSocial = Service::where('nom', 'Service social')->first();
        $ServiceSocial->update(['nom' => 'Pôle Médical']);

        $ServiceMedical = Service::where('nom', 'Service médical')->first();
        $ServiceMedical->update(['nom' => 'Kinésithérapeute']);

        $ServiceEducatif = Service::where('nom', 'Service Éducatif')->first();
        $ServiceEducatif->update(['nom' => 'Pôle Éducatif']);

        $formationProfessionnelle = Service::where('nom', 'Service de la Formation Professionnelle')->first();
        $formationProfessionnelle->update(['nom' => 'Formation Professionnelle']);

        $serviceSportif = Service::where('nom', 'Service sportif')->first();
        $serviceSportif->update(['nom' => 'Pôle sportif']);



        $service = Service::insert([

            [
                'nom' => 'Dentiste',
                'description' => 'description Orientation 6',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Pshycomotricité',
                'description' => 'description Orientation 7',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Ergothérapie',
                'description' => 'description Orientation 8',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Orthoptiste',
                'description' => 'description Orientation 9',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Orthophoniste',
                'description' => 'description Orientation 10',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
        ]);

    }
}
