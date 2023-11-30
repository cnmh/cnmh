<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();

        $password = Hash::make("admin");
        $social = Hash::make("social");
        $medecin = Hash::make("medecin");

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => $password,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $admin->assignRole('admin');

        $permissionAdmin = [
            'index-EtatCivil',
            'create-EtatCivil',
            'edit-EtatCivil',
            'show-EtatCivil',
            'update-EtatCivil',
            'destroy-EtatCivil',
            'export-EtatCivil',
            'import-EtatCivil',
            'index-Permission',
            'create-Permission',
            'show-Permission',
            'edit-Permission',
            'update-Permission',
            'destroy-Permission',
            'export-Permission',
            'import-Permission',
            'index-Role',
            'store-Role',
            'create-Role',
            'export-Role',
            'import-Role',
            'show-Role',
            'edit-Role',
            'update-Role',
            'destroy-Role',
            'index-Employe',
            'create-Employe',
            'show-Employe',
            'edit-Employe',
            'update-Employe',
            'destroy-Employe',
            'export-Employe',
            'import-Employe',
            'index-CouvertureMedical',
            'create-CouvertureMedical',
            'show-CouvertureMedical',
            'edit-CouvertureMedical',
            'update-CouvertureMedical',
            'destroy-CouvertureMedical',
            'export-CouvertureMedical',
            'import-CouvertureMedical',
            'index-TypeHandicap',
            'create-TypeHandicap',
            'show-TypeHandicap',
            'edit-TypeHandicap',
            'update-TypeHandicap',
            'destroy-TypeHandicap',
            'export-TypeHandicap',
            'import-TypeHandicap',
            'index-Service',
            'create-Service',
            'show-Service',
            'edit-Service',
            'update-Service',
            'destroy-Service',
            'export-Service',
            'import-Service',
            'index-NiveauScolaire',
            'show-NiveauScolaire',
            'create-NiveauScolaire',
            'edit-NiveauScolaire',
            'update-NiveauScolaire',
            'destroy-NiveauScolaire',
            'export-NiveauScolaire',
            'import-NiveauScolaire',
            'addPermissionsAuto-Permission',
            'showRolePermission-Permission',
            'assignRolePermission-Permission',
            'index-User',
            'create-User',
            'show-User',
            'edit-User',
            'update-User',
            'destroy-User',
            'import-User',
            'export-User',
            'index-DossierPatient',
            'create-DossierPatient',
            'show-DossierPatient',
            'edit-DossierPatient',
            'update-DossierPatient',
            'store-DossierPatient',
            'destroy-DossierPatient',
            'export-DossierPatient',
            'import-DossierPatient',

        ];

        $admin->givePermissionTo($permissionAdmin);
        $user = User::insert([

            [
                'name' => 'service social',
                'email' => 'social@gmail.com',
                'password' => $social,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Medecin générale',
                'email' => 'medecin@gmail.com',
                'password' => $medecin,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ]);

    }
}
