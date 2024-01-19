<?php

namespace Database\Seeders\Autorizations;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class Maintenance_1_2_2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Ajouter dentiste
         */

        $dentistePassword = Hash::make("dentiste");
        $orthophonistePassword = Hash::make("orthophoniste");
        $now = \Carbon\Carbon::now();

        $medecin = User::where('email', 'medecin@gmail.com')->first();
        $dentiste = User::where('email', 'dentiste@gmail.com')->first();
        $orthophoniste = User::where('email', 'orthophoniste@gmail.com')->first();
        $social = User::where('email', 'social@gmail.com')->first();


        if(empty($dentiste)){
            $dentiste = User::create([
                'name' => 'dentiste',
                'email' => 'dentiste@gmail.com',
                'password' => $dentistePassword,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }


        if(empty($orthophoniste)){
            $orthophoniste = User::create([
                'name' => 'orthophoniste',
                'email' => 'orthophoniste@gmail.com',
                'password' => $orthophonistePassword,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
    
        }
     
        if ($dentiste) {
            $permissionNames = [
                "edit-Consultation",
                "show-Consultation",
                'destroy-Consultation',
                'list_dossier-EntretienSocial',
                'show_dossier-EntretienSocial',
                'update-Consultation'
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $dentiste->givePermissionTo($permissionNames);
        }

        if ($orthophoniste) {
            $permissionNames = [
                "edit-Consultation",
                "show-Consultation",
                'destroy-Consultation',
                'list_dossier-EntretienSocial',
                'show_dossier-EntretienSocial',
                'update-Consultation'
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $orthophoniste->givePermissionTo($permissionNames);
        }
        
        
        if($medecin){
            $permissionNames = [
                "destroy-RendezVous",
                'destroy-Consultation',
                'list_dossier-EntretienSocial',
                'show_dossier-EntretienSocial',
                'update-Consultation'
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $medecin->givePermissionTo($permissionNames);
        }

        if($social){
            $permissionNames = [
                "destroy-Patient",
                "show-Patient"
            ];

            foreach ($permissionNames as $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }

            $medecin->givePermissionTo($permissionNames);
        }
    }
}
