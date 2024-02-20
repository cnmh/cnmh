<?php

namespace Database\Seeders\Autorizations;
use Illuminate\Database\Seeder;
use App\Models\CouvertureMedical;

class Maintenance_1_2_3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couvertureMedical = CouvertureMedical::where('nom','Ne sait pas')->first();
        $couvertureMedical->update([
            'nom' => 'Aucune'
        ]);
    }
}
