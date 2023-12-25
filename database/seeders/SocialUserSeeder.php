<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class SocialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();
        $social = Hash::make("social");

       // Social service and general medicine fake accounts with permissions for testing.

        $service_social = User::create([
            'name' => 'service social',
            'email' => 'social@gmail.com',
            'password' => $social,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $permissionServiceSocial = [
            "index-DossierPatient",
            "edit-DossierPatient",
            "store-DossierPatient",
            "update-DossierPatient",
            "index-Consultation",
            "index-RendezVous",
            "show-Consultation",
            "list_dossier-RendezVous",
            "create-RendezVous",
            "store-RendezVous",
            "show-RendezVous",
            "edit-RendezVous",
            "destroy-RendezVous",
            "create-DossierPatient",
            "parent-DossierPatient",
            "create-Tuteur",
            "patient-DossierPatient",
            "store-Tuteur",
            "show-Tuteur",
            "export-Tuteur",
            "import-Tuteur",
            "edit-Tuteur",
            "destroy-Tuteur",
            "update-Tuteur",
            "index-Tuteur",
            "create-Patient",
            "store-Patient",
            "entretien-DossierPatient",
            "show-DossierPatient",
            "export-DossierPatient",
            "import-DossierPatient",

        ];
        $service_social->givePermissionTo($permissionServiceSocial);
       
    }
}
