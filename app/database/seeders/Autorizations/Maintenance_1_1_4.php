<?php

namespace Database\Seeders\Autorizations;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Maintenance_1_1_4 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Attribuer autorisation au service social 
         */

        $medecin = User::where('email', 'medecin@gmail.com')->first();

        if ($medecin) {
            $permissionNames = [
                "update-Consultation",
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $medecin->givePermissionTo($permissionNames);
        }
    }
}
