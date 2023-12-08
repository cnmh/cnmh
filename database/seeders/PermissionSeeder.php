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
        // Admin EtaCivil Permission 

        Permission::create([
            'name' => 'index-EtatCivil',
        ]);
        Permission::create([
            'name' => 'create-EtatCivil',
        ]);
        Permission::create([
            'name' => 'store-EtatCivil',
        ]);
        Permission::create([
            'name' => 'edit-EtatCivil',
        ]);
        Permission::create([
            'name' => 'show-EtatCivil',
        ]);
        Permission::create([
            'name' => 'update-EtatCivil',
        ]);
        Permission::create([
            'name' => 'destroy-EtatCivil',
        ]);
        Permission::create([
            'name' => 'export-EtatCivil',
        ]);
        Permission::create([
            'name' => 'import-EtatCivil',
        ]);

        // Admin adding Permissions permission

        Permission::create([
            'name' => 'index-Permission',
        ]);
        Permission::create([
            'name' => 'create-Permission',
        ]);
        Permission::create([
            'name' => 'show-Permission',
        ]);
        Permission::create([
            'name' => 'store-Permission',
        ]);
        Permission::create([
            'name' => 'edit-Permission',
        ]);
        Permission::create([
            'name' => 'update-Permission',
        ]);
        Permission::create([
            'name' => 'destroy-Permission',
        ]);
        Permission::create([
            'name' => 'export-Permission',
        ]);
        Permission::create([
            'name' => 'import-Permission',
        ]);

        // Admin adding Role permission

        Permission::create([
            'name' => 'index-Role',
        ]);
        Permission::create([
            'name' => 'create-Role',
        ]);
        Permission::create([
            'name' => 'store-Role',
        ]);
        Permission::create([
            'name' => 'show-Role',
        ]);
        Permission::create([
            'name' => 'edit-Role',
        ]);
        Permission::create([
            'name' => 'update-Role',
        ]);
        Permission::create([
            'name' => 'destroy-Role',
        ]);
        Permission::create([
            'name' => 'export-Role',
        ]);
        Permission::create([
            'name' => 'import-Role',
        ]);

        // Admin , Adding Niveau Scolaire permission

        Permission::create([
            'name' => 'index-NiveauScolaire'
        ]);
        Permission::create([
            'name' => 'show-NiveauScolaire'
        ]);
        Permission::create([
            'name' => 'create-NiveauScolaire'
        ]);
        Permission::create([
            'name' => 'store-NiveauScolaire'
        ]);
        Permission::create([
            'name' => 'edit-NiveauScolaire'
        ]);
        Permission::create([
            'name' => 'update-NiveauScolaire'
        ]);
        Permission::create([
            'name' => 'destroy-NiveauScolaire'
        ]);
        Permission::create([
            'name' => 'export-NiveauScolaire'
        ]);
        Permission::create([
            'name' => 'import-NiveauScolaire'
        ]);

        // Adding employes crud permission

        Permission::create([
            'name' => 'index-Employe',
        ]);
        Permission::create([
            'name' => 'create-Employe',
        ]);
        Permission::create([
            'name' => 'show-Employe',
        ]);
        Permission::create([
            'name' => 'store-Employe',
        ]);
        Permission::create([
            'name' => 'edit-Employe',
        ]);
        Permission::create([
            'name' => 'update-Employe',
        ]);
        Permission::create([
            'name' => 'destroy-Employe',
        ]);
        Permission::create([
            'name' => 'export-Employe',
        ]);
        Permission::create([
            'name' => 'import-Employe',
        ]);

        // Adding Couverture Médicale crud permission

        Permission::create([
            'name' => 'index-CouvertureMedical',
        ]);
        Permission::create([
            'name' => 'create-CouvertureMedical',
        ]);
        Permission::create([
            'name' => 'store-CouvertureMedical',
        ]);
        Permission::create([
            'name' => 'show-CouvertureMedical',
        ]);
        Permission::create([
            'name' => 'edit-CouvertureMedical',
        ]);
        Permission::create([
            'name' => 'update-CouvertureMedical',
        ]);
        Permission::create([
            'name' => 'destroy-CouvertureMedical',
        ]);
        Permission::create([
            'name' => 'export-CouvertureMedical',
        ]);
        Permission::create([
            'name' => 'import-CouvertureMedical',
        ]);

        // Adding Type Handicap crud permission

        Permission::create([
            'name' => 'index-TypeHandicap',
        ]);
        Permission::create([
            'name' => 'create-TypeHandicap',
        ]);
        Permission::create([
            'name' => 'store-TypeHandicap',
        ]);
        Permission::create([
            'name' => 'show-TypeHandicap',
        ]);
        Permission::create([
            'name' => 'edit-TypeHandicap',
        ]);
        Permission::create([
            'name' => 'update-TypeHandicap',
        ]);
        Permission::create([
            'name' => 'destroy-TypeHandicap',
        ]);
        Permission::create([
            'name' => 'export-TypeHandicap',
        ]);
        Permission::create([
            'name' => 'import-TypeHandicap',
        ]);

        // Adding Services (prestations) crud permission

        Permission::create([
            'name' => 'index-Service',
        ]);
        Permission::create([
            'name' => 'create-Service',
        ]);
        Permission::create([
            'name' => 'store-Service',
        ]);
        Permission::create([
            'name' => 'show-Service',
        ]);
        Permission::create([
            'name' => 'edit-Service',
        ]);
        Permission::create([
            'name' => 'update-Service',
        ]);
        Permission::create([
            'name' => 'destroy-Service',
        ]);
        Permission::create([
            'name' => 'export-Service',
        ]);
        Permission::create([
            'name' => 'import-Service',
        ]);

        // Adding Auto permissions button action permissions

        Permission::create([
            'name' => 'addPermissionsAuto-Permission',
        ]);
        Permission::create([
            'name' => 'showRolePermission-Permission',
        ]);
        Permission::create([
            'name' => 'assignRolePermission-Permission',
        ]);
        Permission::create([
            'name' => 'getPermissionsAction-Permission',
        ]);
        Permission::create([
            'name' => 'userAssignedPermissions-Permission',
        ]);

        // Adding User crud permissions

        Permission::create([
            'name' => 'index-User',
        ]);
        Permission::create([
            'name' => 'create-User',
        ]);
        Permission::create([
            'name' => 'show-User',
        ]);
        Permission::create([
            'name' => 'edit-User',
        ]);
        Permission::create([
            'name' => 'update-User',
        ]);
        Permission::create([
            'name' => 'store-User',
        ]);
        Permission::create([
            'name' => 'destroy-User',
        ]);
        Permission::create([
            'name' => 'import-User',
        ]);
        Permission::create([
            'name' => 'export-User',
        ]);

        // Adding dossier patient permissions 

        Permission::create([
            'name' => 'index-DossierPatient',
        ]);
        Permission::create([
            'name' => 'create-DossierPatient',
        ]);
        Permission::create([
            'name' => 'parent-DossierPatient',
        ]);
        Permission::create([
            'name' => 'show-DossierPatient',
        ]);
        Permission::create([
            'name' => 'create-Tuteur',
        ]);
        Permission::create([
            'name' => 'patient-DossierPatient',
        ]);
        Permission::create([
            'name' => 'edit-DossierPatient',
        ]);
        Permission::create([
            'name' => 'store-Tuteur',
        ]);
        Permission::create([
            'name' => 'show-Tuteur',
        ]);
        Permission::create([
            'name' => 'export-Tuteur',
        ]);
        Permission::create([
            'name' => 'import-Tuteur',
        ]);
        Permission::create([
            'name' => 'edit-Tuteur',
        ]);
        Permission::create([
            'name' => 'destroy-Tuteur',
        ]);
        Permission::create([
            'name' => 'index-Tuteur',
        ]);
        Permission::create([
            'name' => 'update-Tuteur',
        ]);
        Permission::create([
            'name' => 'update-DossierPatient',
        ]);
        Permission::create([
            'name' => 'store-DossierPatient',
        ]);
        Permission::create([
            'name' => 'destroy-DossierPatient',
        ]);
        Permission::create([
            'name' => 'export-DossierPatient',
        ]);
        Permission::create([
            'name' => 'import-DossierPatient',
        ]);
        Permission::create([
            'name' => 'create-Patient',
        ]);
        Permission::create([
            'name' => 'store-Patient',
        ]);
        Permission::create([
            'name' => 'entretien-DossierPatient',
        ]);

        // Adding consultation permissions 

        Permission::create([
            'name' => 'index-Consultation',
        ]);
        Permission::create([
            'name' => 'create-Consultation',
        ]);
        Permission::create([
            'name' => 'show-Consultation',
        ]);
        Permission::create([
            'name' => 'edit-Consultation',
        ]);
        Permission::create([
            'name' => 'update-Consultation',
        ]);
        Permission::create([
            'name' => 'store-Consultation',
        ]);
        Permission::create([
            'name' => 'destroy-Consultation',
        ]);
        Permission::create([
            'name' => 'export-Consultation',
        ]);
        Permission::create([
            'name' => 'import-Consultation',
        ]);
        Permission::create([
            'name' => 'patient-Consultation',
        ]);


        // Adding Rendez-vous permissions 

        Permission::create([
            'name' => 'index-RendezVous',
        ]);
        Permission::create([
            'name' => 'create-RendezVous',
        ]);
        Permission::create([
            'name' => 'show-RendezVous',
        ]);
        Permission::create([
            'name' => 'edit-RendezVous',
        ]);
        Permission::create([
            'name' => 'update-RendezVous',
        ]);
        Permission::create([
            'name' => 'store-RendezVous',
        ]);
        Permission::create([
            'name' => 'destroy-RendezVous',
        ]);
        Permission::create([
            'name' => 'export-RendezVous',
        ]);
        Permission::create([
            'name' => 'import-RendezVous',
        ]);
        Permission::create([
            'name' => 'list_dossier-RendezVous',
        ]);
        Permission::create([
            'name' => 'Ajouter_RendezVous-Consultation',
        ]);


    }
}
