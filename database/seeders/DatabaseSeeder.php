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
use Database\Seeders\TuteursTableSeeder;


/**
 * Class DatabaseSeeder
 *
 * @author Amine Lamchatab
 * CodeCampers
 */



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            AppMenuSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            EtatCivilsTableSeeder::class,
            ServicesTableSeeder::class,
            TuteursTableSeeder::class,
            CouvertureMedicalsTableSeeder::class,
            TypeHandicapsTableSeeder::class,
            FonctionsTableSeeder::class,
            NiveauScolairesTableSeeder::class,
            PatientsTableSeeder::class,
            EmployesTableSeeder::class,

            DossierPatientsTableSeeder::class,

            OrientationExternesTableSeeder::class,

            ConsultationsTableSeeder::class,


            DossierPatientServiceSeeder::class,
            DossierPatientTypeHandicapSeeder::class,
            DossierPatientConsultationTableSeeder::class,
            

            // RendezVousesTableSeeder::class,

            // DossierPatientConsultationTableSeeder::class,
            // ProjectsTableSeeder::class,

            ReclamationsTableSeeder::class,
            // MembersTableSeeder::class,
        ]);

    }
}
