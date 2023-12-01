<?php

namespace Database\Seeders;

use App\Models\Consultation;
use App\Models\MenuGroup;
use App\Models\MenuItem;
use App\Models\OrientationExterne;
use App\Models\Patient;
use App\Models\Reclamation;
use App\Models\RendezVous;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceSocialGroup = MenuGroup::create([
            'nom' => 'Service social',
            'description' => "service social",
            'icon' => '<i class="fa-solid fa-users"></i>',
        ]);
        $medcineGenerale = MenuGroup::create([
            'nom' => 'Medcine générale',
            'description' => "medecin generale",
            'icon' => '<i class="fa-solid fa-users"></i>',
        ]);
        $dentist = MenuGroup::create([
            'nom' => 'Dentiste',
            'description' => "dentiste",
            'icon' => '<i class="fa-solid fa-users"></i>',
        ]);

        $parametresGroup = MenuGroup::create([
            'nom' => 'Paramètres',
            'description' => "admin",
            'icon' => '<i class="fa-solid fa-gears"></i>',
        ]);

        $permissionsGroup = MenuGroup::create([
            'nom' => 'Gestion Permissions',
            'description' => "admin",
            'icon' => '<i class="fa-solid fa-gears"></i>',
        ]);

        $menu = [
            [
                'nom' => __('Dossier bénéficiaire'),
                'icon' => '<i class="fa-solid fa-hospital-user"></i>',
                'url' => 'dossier-patients.index',
            ],

            //menu service social
            // [
            //     'nom' => __('Dossier social'),
            //     'icon' => null,
            //     'url' => 'dossier-patients.index',
            //     'menu_group_id' => $serviceSocialGroup->id,
            // ],
            [

                'nom' => __("List d'attente"),
                'description' => "service social",
                'icon' => null,
                'url' => '/consultations/liste-attente',
                'menu_group_id' => $serviceSocialGroup->id,
            ],
            [
                'nom' => __("Rendez-vous"),
                'description' => "service social",
                'icon' => null,
                'url' => 'rendez-vous.index',
                'menu_group_id' => $serviceSocialGroup->id,
            ],
            // Medecin generale
            [
                'nom' => __("Consultation"),
                'description' => "medecin generale",
                'icon' => null,
                'url' => '/consultations/MedecinGeneral',
                'menu_group_id' => $medcineGenerale->id,
            ],
            // Dentist
            [
                'nom' => __("Dentiste"),
                'description' => "dentiste",
                'icon' => null,
                'url' => '/consultations/dentiste',
                'menu_group_id' => $dentist->id,
            ],


            // parametre

            [
                'nom' => __('Prestations'),
                'description' => "admin",
                'icon' => null,
                'url' => 'services.index',
                'menu_group_id' => $parametresGroup->id,
            ],
            [
                'nom' => __('Type d\'handicaps'),
                'description' => "admin",
                'icon' => null,
                'url' => 'typeHandicaps.index',
                'menu_group_id' => $parametresGroup->id,
            ],
            [
                'nom' => __('Couverture Médicale'),
                'description' => "admin",
                'icon' => null,
                'url' => 'couvertureMedicals.index',
                'menu_group_id' => $parametresGroup->id,
            ],
            [
                'nom' => __('Employés'),
                'description' => "admin",
                'icon' => null,
                'url' => 'employes.index',
                'menu_group_id' => $parametresGroup->id,
            ],
            [
                'nom' => __('NiveauScolaires'),
                'description' => "admin",
                'icon' => null,
                'url' => 'niveauScolaires.index',
                'menu_group_id' => $parametresGroup->id,
            ],
            [
                'nom' => __('EtatCivils'),
                'description' => "admin",
                'icon' => null,
                'url' => 'etatCivils.index',
                'menu_group_id' => $parametresGroup->id,
            ],
            [
                'nom' => __('Rôles'),
                'description' => "admin",
                'icon' => null,
                'url' => 'roles.index',
                'menu_group_id' => $permissionsGroup->id,
            ],
            [
                'nom' => __('Permissions'),
                'description' => "admin",
                'icon' => null,
                'url' => 'permissions.index',
                'menu_group_id' => $permissionsGroup->id,
            ],
            [
                'nom' => __('Attribuer des autorisations'),
                'description' => "admin",
                'icon' => null,
                'url' => 'users.index',
                'menu_group_id' => $permissionsGroup->id,
            ]
        ];

        foreach ($menu as $item) {
            MenuItem::create($item);
        }
    }
}
