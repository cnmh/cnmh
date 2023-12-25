<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();

        $password = Hash::make("admin");

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
            'store-EtatCivil',
            'update-EtatCivil',
            'destroy-EtatCivil',
            'export-EtatCivil',
            'import-EtatCivil',
            'index-Employe',
            'create-Employe',
            'store-Employe',
            'show-Employe',
            'edit-Employe',
            'update-Employe',
            'destroy-Employe',
            'export-Employe',
            'import-Employe',
            'index-CouvertureMedical',
            'create-CouvertureMedical',
            'store-CouvertureMedical',
            'show-CouvertureMedical',
            'edit-CouvertureMedical',
            'update-CouvertureMedical',
            'destroy-CouvertureMedical',
            'export-CouvertureMedical',
            'import-CouvertureMedical',
            'index-TypeHandicap',
            'create-TypeHandicap',
            'store-TypeHandicap',
            'show-TypeHandicap',
            'edit-TypeHandicap',
            'update-TypeHandicap',
            'destroy-TypeHandicap',
            'export-TypeHandicap',
            'import-TypeHandicap',
            'index-Service',
            'create-Service',
            'store-Service',
            'show-Service',
            'edit-Service',
            'update-Service',
            'destroy-Service',
            'export-Service',
            'import-Service',
            'index-NiveauScolaire',
            'show-NiveauScolaire',
            'create-NiveauScolaire',
            'store-NiveauScolaire',
            'edit-NiveauScolaire',
            'update-NiveauScolaire',
            'destroy-NiveauScolaire',
            'export-NiveauScolaire',
            'import-NiveauScolaire',
            

        ];
        $admin->givePermissionTo($permissionAdmin);

    }
}
