<?php

namespace Database\Seeders\Autorizations;

use App\Models\Service;
use Illuminate\Database\Seeder;

class Maintenance_2_5_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $servicesToUpdate = [
            'Service social' => 'Pôle Médical',
            'Service médical' => 'Kinesitherapeute',
            'Service Éducatif' => 'Pôle Éducatif',
            'Service de la Formation Professionnelle' => 'Formation Professionnelle',
            'Service sportif' => 'Pôle sportif',
            'Dentiste'=> 'Dentiste',
            'Pshycomotricité' => 'Psychomotricien',
            'Kinésithérapeute' => 'Kinesitherapeute',
            'Ergothérapie' => 'Ergotherapie',
            'Orthophoniste' => 'Orthophoniste',
            'Orthoptiste' => 'Orthoptiste'
        ];

        foreach ($servicesToUpdate as $serviceName => $newName) {
            Service::updateOrCreate(
                ['nom' => $serviceName],
                ['nom' => $newName, 'updated_at' => $now]
            );
        }

    }
}
