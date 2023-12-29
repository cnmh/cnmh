<?php

namespace Database\Seeders;

use App\Models\NiveauScolaire;
use Illuminate\Database\Seeder;



/**
 * Class NiveauScolairesTableSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */





class NiveauScolairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $niveauScholaire = NiveauScolaire::insert([
            [
                'nom' => 'Maternelle',
                'description' => 'description de niveau scholaire',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Ecole primaire',
                'description' => 'description de niveau scholaire',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Collége',
                'description' => 'description de niveau scholaire',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Lycéé',
                'description' => 'description de niveau scholaire',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Université',
                'description' => 'description de niveau scholaire',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);


    }
}
