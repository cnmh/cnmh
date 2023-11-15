<?php

namespace Database\Seeders;

use App\Models\Fonction;
use Illuminate\Database\Seeder;

class FonctionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $fonction = Fonction::insert([
            [
                'nom' => 'Assistanat / Secrétariat',
                'description' => 'Description de fonction',
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ]);

    }
}
