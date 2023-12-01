<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // TODO: Ajouter les roles

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'service social',
        ]);
        
    }
}
