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
            'password'=> $password,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $admin->assignRole('admin');

        $permissionAdmin = [
            'index-EtatCivilController',
            'index-PermissionController',
            'addPermissionsAuto-PermissionController',
            'index-UserController',
            'showRolePermission-PermissionController',
            'assignRolePermission-PermissionController',

        ];

        $admin->givePermissionTo($permissionAdmin);
        $user = User::insert([
           
            [
                'name' => 'service social',
                'email' => 'social@gmail.com',
                'password'=>$social,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Medecin générale',
                'email' => 'medecin@gmail.com',
                'password'=>$medecin,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ]);

    }
}
