<?php

namespace Database\Seeders\Social;

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
                'cin'=>'K05001',
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
                'email'=>'lharrak@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00401',
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
                'email'=>'azize@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00201',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'etat_civil_id' =>EtatCivil::inRandomOrder()->first()->id,
                'nom' => 'Amine',
                'prenom' => 'Alami',
                'sexe'=>'Homme',
                'telephone'=>'06000000001',
                'email'=>'amine@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00301',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'etat_civil_id' =>EtatCivil::inRandomOrder()->first()->id,
                'nom' => 'karim',
                'prenom' => 'ben ali',
                'sexe'=>'Homme',
                'telephone'=>'06000000001',
                'email'=>'karim@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K90301',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ]);

    }
}
