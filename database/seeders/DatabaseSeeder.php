<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

use Database\Seeders\Config\{
    AppMenuSeeder
};
use Database\Seeders\Autorizations\{
    AuthorisationSeeder,
    PermissionSeeder,
    RoleSeeder,
    UserSeeder,
    Maintenance_1_1_1,
    Maintenance_1_1_2,
    Maintenance_1_1_3,
    Maintenance_1_2_1
};
use Database\Seeders\Parameters\{
    CouvertureMedicalsTableSeeder,
    EmployesTableSeeder,
    EtatCivilsTableSeeder,
    FonctionsTableSeeder,
    NiveauScolairesTableSeeder,
    ServicesTableSeeder,
    TypeHandicapsTableSeeder
};
use Database\Seeders\Social\{
    PatientsTableSeeder,
    RendezVousesTableSeeder,
    TuteursTableSeeder,
    DossierPatientTableSeeder
};
use Database\Seeders\Medical\{
    ConsultationsTableSeeder
};
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $classes = [];
        $classes = array_merge(
            ConfigSeeder::Classes(),
            AutorizationsSeeder::Classes(),
            ParametersSeeder::Classes(),
            SocialSeeder::Classes(),
        );
        $this->call($classes);


        // $this->call([
        //     EtatCivilsTableSeeder::class,
        //     ServicesTableSeeder::class,
        //     CouvertureMedicalsTableSeeder::class,
        //     TypeHandicapsTableSeeder::class,
        //     FonctionsTableSeeder::class,
        //     NiveauScolairesTableSeeder::class,


        //     // AppMenuSeeder::class,
        //     // PermissionSeeder::class,
        //     // RoleSeeder::class,
        //     // UserSeeder::class,
        //     // TuteursTableSeeder::class,
           
        //     // PatientsTableSeeder::class,
        //     // EmployesTableSeeder::class,
        //     // DossierPatientsTableSeeder::class,
        //     // OrientationExternesTableSeeder::class,
        //     // Maintenance_1_1_1::class,
        //     // Maintenance_1_1_2::class,


        //     // ConsultationsTableSeeder::class,
        //     // RendezVousesTableSeeder::class,
        //     // DossierPatientConsultationTableSeeder::class,
        //     // MembersTableSeeder::class,
        // ]);

    }
}
