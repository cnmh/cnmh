<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Reclamation;
use Illuminate\Database\Seeder;

class ReclamationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = \Carbon\Carbon::now();
        $reclmation = Reclamation::insert([
            [
                'patient_id'=>Patient::inRandomOrder()->first()->id,

                'objet'=>"Temps d'attente",
                'reclamation'=>"J'attends depuis un certain temps dans la salle d'attente.",
                'date_reclamation'=>'2023-07-1',
                'created_at'=> $now,
                'updated_at'=>$now
            ],
            [
                'patient_id'=>Patient::inRandomOrder()->first()->id,
                'objet'=>"Rendez-vous",
                'reclamation'=>"Vous m'avez dit que vous me rappelleriez pour un rendez-vous, mais vous ne l'avez pas fait.",
                'date_reclamation'=>'2023-07-1',
                'created_at'=> $now,
                'updated_at'=>$now
            ]
            ]);
    }
}
