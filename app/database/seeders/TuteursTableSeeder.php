<?php

namespace Database\Seeders;

use App\Models\Tuteur;
use App\Models\EtatCivil;
use Illuminate\Database\Seeder;

class TuteursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $tuteur = Tuteur::insert([
            [
                'etat_civil_id' => EtatCivil::inRandomOrder()->first()->id,
                'nom' => 'Stito',
                'prenom' => 'Nada',
                'sexe'=>'Homme',
                'telephone'=>'06000000001',
                'email'=>'madani@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00001',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'etat_civil_id' => EtatCivil::inRandomOrder()->first()->id,
                'nom' => 'Lharrak',
                'prenom' => 'botaina',
                'sexe'=>'Femme',
                'telephone'=>'06000000001',
                'email'=>'madani@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00001',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'etat_civil_id' =>EtatCivil::inRandomOrder()->first()->id,
                'nom' => 'Aziz',
                'prenom' => 'Swihli',
                'sexe'=>'Homme',
                'telephone'=>'06000000001',
                'email'=>'madani@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00001',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ]);

    }
}
