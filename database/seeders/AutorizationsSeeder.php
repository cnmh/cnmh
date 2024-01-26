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

use Database\Seeders\Autorizations\{
    AuthorisationSeeder,
    PermissionSeeder,
    RoleSeeder,
    UserSeeder,
    Maintenance_1_1_1,
    Maintenance_1_1_2,
    Maintenance_1_1_3,
    Maintenance_1_2_0,
    Maintenance_1_1_4,
    Maintenance_1_2_1,
    Maintenance_1_1_6,
    Maintenance_1_2_2
};
 
/**
 * php artisan db:seed --class=AutorizationsSeeder
 */
class AutorizationsSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(AutorizationsSeeder::Classes());
    }

    public static function Classes(): array
    {
        return  [
            AuthorisationSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            Maintenance_1_1_1::class,
            Maintenance_1_1_2::class,
            Maintenance_1_1_3::class,
            Maintenance_1_2_0::class,
            Maintenance_1_1_4::class,
            Maintenance_1_2_1::class,
            Maintenance_1_1_6::class,
            Maintenance_1_2_2::class,
        ];
    }
}