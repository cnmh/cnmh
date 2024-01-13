<?php

namespace Database\Seeders\Autorizations;


use App\Models\CouvertureMedical;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Maintenance_1_1_7 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Attribuer autorisation au service social 
         */
        $now = \Carbon\Carbon::now();

        $social = CouvertureMedical::insert([
            'nom' => 'AMO tadamon',
            'description' => 'h',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

    }
}
