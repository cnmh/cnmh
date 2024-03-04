<?php

namespace Database\Seeders\Autorizations;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Maintenance_1_1_3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Attribuer autorisation au service social 
         */

        $social = User::where('email', 'social@gmail.com')->first();

        if ($social) {
            $permissionNames = [
                'update-RendezVous',
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $social->givePermissionTo($permissionNames);
        }
    }
}
