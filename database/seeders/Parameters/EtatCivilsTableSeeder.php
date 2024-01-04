<?php

namespace Database\Seeders\Parameters;


use App\Models\EtatCivil;
use Illuminate\Database\Seeder;

/**
 * php artisan db:seed --class="Database\Seeders\Tests\EtatCivilsTableSeeder"
 * 
 */
class EtatCivilsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\EtatCivil::factory(8)->create();
        $now = \Carbon\Carbon::now();

        $etat_civil = EtatCivil::insert([
            [
                'nom' => 'Marié(e)',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Divorcé(e)',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Célibataire',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Veuf(ve)',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

    }
}
