<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class MedecinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();

        $medecin = Hash::make("medecin");
  
        $medecin_generale = User::create([
            'name' => 'Medecin générale',
            'email' => 'medecin@gmail.com',
            'password' => $medecin,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $permissionMedecinGenerale = [
            "index-Consultation",
            "show-Consultation",
            "edit-Consultation",
            "patient-Consultation",
            "create-Consultation",
            "show-DossierPatient",
            "Ajouter_RendezVous-Consultation",
            "index-DossierPatient",
            "store-Consultation",
            "destroy-RendezVous",
        ];
        $medecin_generale->givePermissionTo($permissionMedecinGenerale);

    }
}
