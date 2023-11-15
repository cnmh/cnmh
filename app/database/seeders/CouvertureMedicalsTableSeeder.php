<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CouvertureMedical;

class CouvertureMedicalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $couvertureMedicals = CouvertureMedical::insert([
            [
                'nom' => 'cnops',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'cnss',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'FAR',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'assurance (complimentaire)',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Ne sait pas',
                'description' => 'h',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
