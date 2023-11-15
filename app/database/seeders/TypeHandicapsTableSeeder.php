<?php

namespace Database\Seeders;

use App\Models\TypeHandicap;
use Illuminate\Database\Seeder;

/**
 * @author CodeCampers, Boukhar Soufiane
*/

class TypeHandicapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $typehandicap = TypeHandicap::insert([
            [
                'nom' => 'TSA V2',
                'description' => 'description type handicap 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'RETARD MENTAL',
                'description' => 'description type handicap 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'TRISOMIE 21',
                'description' => 'description type handicap 3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'IMC',
                'description' => 'description type handicap 4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'RPM',
                'description' => 'description type handicap 5',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'RETARD DE LANGUAGE',
                'description' => ' description type handicap 6',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'HANDICAP MOTEUR',
                'description' => 'description type handicap 7',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'AUTRES',
                'description' => 'description type handicap 8',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
