<?php

namespace Database\Seeders\Autorizations;


use App\Models\NiveauScolaire;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Maintenance_1_1_8 extends Seeder
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

       $niveauxScolaire = NiveauScolaire::insert([
        [
            'nom' => 'Aucun',
            'description' => 'h',
            'created_at' => $now,
            'updated_at' => $now,
        ],
       ]);
    }
}
