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

use Database\Seeders\Parameters\{
    CouvertureMedicalsTableSeeder,
    EmployesTableSeeder,
    EtatCivilsTableSeeder,
    FonctionsTableSeeder,
    NiveauScolairesTableSeeder,
    ServicesTableSeeder,
    TypeHandicapsTableSeeder
};

/**
 * php artisan db:seed --class=ParametersSeeder
 */
class ParametersSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(ParametersSeeder::Classes());
    }

    public static function Classes(): array
    {
        return  [
            EtatCivilsTableSeeder::class,
            ServicesTableSeeder::class,
            CouvertureMedicalsTableSeeder::class,
            TypeHandicapsTableSeeder::class,
            FonctionsTableSeeder::class,
            NiveauScolairesTableSeeder::class,
        ];
    }
}