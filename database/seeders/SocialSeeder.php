<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tuteur;
use App\Models\Patient;
use App\Models\EtatCivil;
use App\Models\MenuGroup;
use App\Models\RendezVous;
use App\Models\Consultation;
use App\Models\NiveauScolaire;
use Illuminate\Database\Seeder;
use Symfony\Component\Uid\NilUuid;

use Database\Seeders\Social\{
    PatientsTableSeeder,
    RendezVousesTableSeeder,
    TuteursTableSeeder,
    DossierPatientTableSeeder
};
 
/**
 * php artisan db:seed --class=SocialSeeder
 */
class SocialSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(SocialSeeder::Classes());
    }

    public static function Classes(): array
    {
        return  [
            TuteursTableSeeder::class,
            PatientsTableSeeder::class,
            DossierPatientTableSeeder::class,
            RendezVousesTableSeeder::class
        ];
    }
}