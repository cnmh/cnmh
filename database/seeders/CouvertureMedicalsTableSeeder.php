<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CouvertureMedical;


/**
 * Class CouvertureMedicalsTableSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */


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
                'nom' => 'CNOPS',
                'description' => 'description de couverture medicals',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'CNSS',
                'description' => 'description de couverture medicals',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'FAR',
                'description' => 'description de couverture medicals',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Assurance (complimentaire)',
                'description' => 'description de couverture medicals',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Autre',
                'description' => 'description de couverture medicals',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
