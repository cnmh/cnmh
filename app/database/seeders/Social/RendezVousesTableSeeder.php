<?php

namespace Database\Seeders\Social;

use Illuminate\Database\Seeder;
use App\Models\RendezVous;

class RendezVousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $rendezVous = RendezVous::insert([
            [
                'consultation_id' => 1,
                'date_rendez_vous' => $now,
                'etat' => 'Planifier',
                'remarques'=> null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'consultation_id' => 3,
                'date_rendez_vous' => $now,
                'etat' => 'Planifier',
                'remarques'=> null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'consultation_id' => 5,
                'date_rendez_vous' => $now,
                'etat' => 'Planifier',
                'remarques'=> null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
           
        ]);

    }
}
