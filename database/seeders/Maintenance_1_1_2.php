<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Maintenance_1_1_2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /**
         * Attribuer autorisation au service social 
         */

        $admin = User::where('name', 'admin')->first();

        if ($serviceSocial) {
            $permissionNames = [
                'InitialiserMtp-User'
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $permissions = Permission::whereIn('name', $permissionNames)->get();

            $admin->givePermissionTo($permissions);
        }
    }
}
