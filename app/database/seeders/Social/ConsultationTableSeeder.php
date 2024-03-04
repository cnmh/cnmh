<?php

namespace Database\Seeders\Social;
use App\Models\Consultation;
use Illuminate\Database\Seeder;

class ConsultationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $consultation = Consultation::insert([
            [
                'date_enregistrement' => $now,
                'date_consultation' => null,
                'observation' => null,
                'diagnostic'=> null,
                'bilan'=> null,
                'type'=> 'medecinGeneral',
                'etat'=> 'enRendezVous',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'date_enregistrement' => $now,
                'date_consultation' => null,
                'observation' => null,
                'diagnostic'=> null,
                'bilan'=> null,
                'type'=> 'medecinGeneral',
                'etat'=> 'enAttente',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'date_enregistrement' => $now,
                'date_consultation' => null,
                'observation' => null,
                'diagnostic'=> null,
                'bilan'=> null,
                'type'=> 'medecinGeneral',
                'etat'=> 'enRendezVous',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'date_enregistrement' => $now,
                'date_consultation' => null,
                'observation' => null,
                'diagnostic'=> null,
                'bilan'=> null,
                'type'=> 'medecinGeneral',
                'etat'=> 'enAttente',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'date_enregistrement' => $now,
                'date_consultation' => null,
                'observation' => null,
                'diagnostic'=> null,
                'bilan'=> null,
                'type'=> 'medecinGeneral',
                'etat'=> 'enRendezVous',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

    }
}
