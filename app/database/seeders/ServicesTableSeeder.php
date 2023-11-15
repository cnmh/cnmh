<?php

namespace Database\Seeders;

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
                'nom' => 'Service social',
                'description' => 'description prestation 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Service médical',
                'description' => 'description prestation 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Service Éducatif',
                'description' => 'description prestation 3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Service de la Formation Professionnelle',
                'description' => 'description prestation 4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Service sportif',
                'description' => 'description prestation 5',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

    }
}
