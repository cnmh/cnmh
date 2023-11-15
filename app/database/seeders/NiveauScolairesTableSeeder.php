<?php

namespace Database\Seeders;

use App\Models\NiveauScolaire;
use Illuminate\Database\Seeder;

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
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Ecole primaire',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Collége',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Lycéé',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Université',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);


    }
}
