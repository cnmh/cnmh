<?php

namespace Database\Seeders\Autorizations;


use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\TypeHandicap;

class Maintenance_1_1_5 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();

        $typehandicap = TypeHandicap::insert([
            [
                'nom' => 'PC Épilepsie',
                'description' => 'description type handicap 9',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    
    }
}
