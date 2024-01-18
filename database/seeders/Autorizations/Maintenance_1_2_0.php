<?php

namespace Database\Seeders\Autorizations;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Maintenance_1_2_0 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Attribuer autorisation entretien social au service social 
         */

        $social = User::where('email', 'social@gmail.com')->first();

        if ($social) {
            $permissionNames = [
                'list_dossier-EntretienSocial',
                'FormSelectTuteur-EntretienSocial',
                'FormAjouteTuteur-EntretienSocial',
                'AjouteTuteur-EntretienSocial',
                'FormSelectPatient-EntretienSocial',
                'SelectTuteur-EntretienSocial',
                'FormAjoutePatient-EntretienSocial',
                'SelectPatient-EntretienSocial',
                'AjoutePatient-EntretienSocial',
                'FormEntretienSocial-EntretienSocial',
                'AjouterEntretienSocial-EntretienSocial',
                'show_dossier-EntretienSocial',
                'edit-EntretienSocial',
                'update-EntretienSocial',
                'destroy-EntretienSocial',
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $social->givePermissionTo($permissionNames);
        }
    }
}
