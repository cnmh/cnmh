<?php

namespace Database\Seeders;

use App\Models\Tuteur;
use App\Models\Patient;
use App\Models\NiveauScolaire;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;



/**
 * Class PatientsTableSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */


class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $now = \Carbon\Carbon::now();

        $patient = Patient::insert([
            [
                'tuteur_id' => Tuteur::inRandomOrder()->first()->id,
                'niveau_scolaire_id'=>NiveauScolaire::inRandomOrder()->first()->id,
                'nom' => 'Yahya',
                'prenom' => 'Mohammed',
                'telephone'=>'0600000004',
                'email'=>'yahya@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00004',
                'image' => $faker->imageUrl(300, 300, 'people'),
                'remarques'=>'remarques de patient',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tuteur_id' => Tuteur::inRandomOrder()->first()->id,
                'niveauxScolaire_id'=>NiveauScolaire::inRandomOrder()->first()->id,
                'nom' => 'EL mliki',
                'prenom' => 'Hicham',
                'telephone'=>'0600000005',
                'email'=>'el_mliki@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00005',
                'image' => $faker->imageUrl(300, 300, 'people'),
                'remarques'=>'remarques de patient',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tuteur_id' => Tuteur::inRandomOrder()->first()->id,
                'niveauxScolaire_id'=>NiveauScolaire::inRandomOrder()->first()->id,
                'nom' => 'Saidi',
                'prenom' => 'Oumaima',
                'telephone'=>'0600000006',
                'email'=>'saidi@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K00006',
                'image' => $faker->imageUrl(300, 300, 'people'),
                'remarques'=>'remarques de patient',
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ]);

    }
}
