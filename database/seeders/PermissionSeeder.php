<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'index-EtatCivilController',
        ]);

        Permission::create([
            'name' => 'index-PermissionController',
        ]);

        Permission::create([
            'name' => 'index-RoleController',
        ]);

        Permission::create([
            'name' => 'addPermissionsAuto-PermissionController',
        ]);

        Permission::create([
            'name' => 'index-UserController',
        ]);
        Permission::create([
            'name' => 'showRolePermission-PermissionController',
        ]);
        Permission::create([
            'name' => 'assignRolePermission-PermissionController',
        ]);

        

       


        




        
    }
}
