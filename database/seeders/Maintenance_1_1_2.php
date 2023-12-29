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

        $admin = User::where('name', 'root')->first();

        if ($admin) {
            $permissionNames = [
                'InitialiserMtp-User',
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $admin->givePermissionTo($permissionNames);
        }
    }
}
