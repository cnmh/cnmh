<?php

namespace Database\Seeders\Social;

use App\Models\Tuteur;
use App\Models\Patient;
use App\Models\NiveauScolaire;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
                'tuteur_id' => 1,
                'niveau_scolaire_id'=>NiveauScolaire::inRandomOrder()->first()->id,
                'nom' => 'yahya',
                'prenom' => 'mohammed',
                'image' => $faker->imageUrl(300, 300, 'people'),
                'telephone'=>'060000001',
                'email'=>'yahya@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K50001',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tuteur_id' => 2,
                'niveauxScolaire_id'=>NiveauScolaire::inRandomOrder()->first()->id,
                'nom' => 'EL mliki',
                'image' => $faker->imageUrl(300, 300, 'people'),
                'prenom' => 'Hicham',
                'telephone'=>'060000001',
                'email'=>'hicham@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K60001',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tuteur_id' => 3,
                'niveauxScolaire_id'=>NiveauScolaire::inRandomOrder()->first()->id,
                'nom' => 'Saidi',
                'prenom' => 'oumaima',
                'telephone'=>'060000001',
                'email'=>'oumaima@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K80001',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
                'image' => $faker->imageUrl(300, 300, 'people'),
            ],
            [
                'tuteur_id' => 4,
                'niveauxScolaire_id'=>NiveauScolaire::inRandomOrder()->first()->id,
                'nom' => 'amro',
                'prenom' => 'oumaima',
                'telephone'=>'060000001',
                'email'=>'oumaima@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K86001',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
                'image' => $faker->imageUrl(300, 300, 'people'),
            ],
            [
                'tuteur_id' => 5,
                'niveauxScolaire_id'=>NiveauScolaire::inRandomOrder()->first()->id,
                'nom' => 'assala',
                'prenom' => 'amina',
                'telephone'=>'060000001',
                'email'=>'amina@gmail.com',
                'adresse'=>'Tanger',
                'cin'=>'K86901',
                'remarques'=>'text',
                'created_at' => $now,
                'updated_at' => $now,
                'image' => $faker->imageUrl(300, 300, 'people'),
            ],

        ]);

    }
}
