<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Seeder;



/**
 * Class ConsultationsTableSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */


class ConsultationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();


        // You can customize the data as per your requirements
        $consultation = Consultation::insert([
            [
                'date_enregistrement' => $now,
                'date_consultation' => '2023-01-10', 
                'observation' => 'Le patient semble en bonne santé.',
                'diagnostic' => 'Aucun problème significatif détecté.',
                'bilan' => 'Résultats normaux.',
                'type' => 'Vérification générale',
                'etat' => 'enAttente',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'date_enregistrement' => $now,
                'date_consultation' => '2023-01-11', 
                'observation' => 'Le patient semble en bonne santé.',
                'diagnostic' => 'Aucun problème significatif détecté.',
                'bilan' => 'Résultats normaux.',
                'type' => 'Vérification générale',
                'etat' => 'enAttente',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'date_enregistrement' => $now,
                'date_consultation' => '2023-01-12', 
                'observation' => 'Le patient semble en bonne santé.',
                'diagnostic' => 'Aucun problème significatif détecté.',
                'bilan' => 'Résultats normaux.',
                'type' => 'Vérification générale',
                'etat' => 'enAttente',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more consultation data as needed
        ]);
    }
}
