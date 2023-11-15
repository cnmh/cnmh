<?php

namespace Database\Seeders;


use App\Models\Employe;
use App\Models\Fonction;

use Illuminate\Database\Seeder;

class EmployesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $niveauScholaire = Employe::insert([
            [
                'nom' => ' souan',

                'prenom'=>'Khawla',
                'email'=>'khawla@gmail.com',
                'telephone'=>'0600000001',
                'adresse'=>'tanger',
                'date_naissance'=>'1998-12-11',
                'cin'=>'K00001',
                'fonction_id'=>Fonction::inRandomOrder()->first()->id,
                'date_embauche'=>'2020-12-11',
                'created_at'=> $now,
                'updated_at'=>$now
            ]

        ]);


    }
}
