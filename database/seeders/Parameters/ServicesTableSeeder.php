<?php

namespace Database\Seeders\Parameters;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $service = Service::insert([
            [
                'nom' => 'Pôle médical',
                'description' => 'description Orientation 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Pôle Éducatif',
                'description' => 'description Orientation 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Formation Professionnelle',
                'description' => 'description Orientation 3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Pôle sportif',
                'description' => 'description Orientation 4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Dentiste',
                'description' => 'description Orientation 5',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Pshycomotricité',
                'description' => 'description Orientation 6',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Ergothérapie',
                'description' => 'description Orientation 7',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Orthoptiste',
                'description' => 'description Orientation 8',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Orthophoniste',
                'description' => 'description Orientation 9',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Kinésithérapeute',
                'description' => 'description Orientation 10',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
        ]);

    }
}
