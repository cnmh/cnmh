<?php

namespace Database\Seeders;

use App\Models\Tuteur;
use App\Models\EtatCivil;
use Illuminate\Database\Seeder;


/**
 * Class TuteursTableSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */

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
                'sexe'=>'Femme',
                'telephone'=>'0600000001',
                'email'=>'stito@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00001',
                'remarques'=>'remarques de tuteur',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'etat_civil_id' => EtatCivil::inRandomOrder()->first()->id,
                'nom' => 'Lharrak',
                'prenom' => 'Botaina',
                'sexe'=>'Femme',
                'telephone'=>'0600000002',
                'email'=>'lharrak@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00002',
                'remarques'=>'remarques de tuteur',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'etat_civil_id' =>EtatCivil::inRandomOrder()->first()->id,
                'nom' => 'Swihli',
                'prenom' => 'Aziz',
                'sexe'=>'Homme',
                'telephone'=>'0600000003',
                'email'=>'swihli@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00003',
                'remarques'=>'remarques de tuteur',
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ]);

    }
}
