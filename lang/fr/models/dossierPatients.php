<?php

return [
    'singular' => 'Dossier bénéficiaire',
    'plural' => 'Dossiers bénéficiaires',
    'fields' => [
        'id' => 'Id',
        'patient_id' => 'Patient',
        'couverture_medical_id' => 'Couverture médicale',
        'type_handicap_id' => "Type d'handicapé",
        'numero_dossier' => 'Numéro Dossier',
        'etat' => 'État',
        'date_enregsitrement' => "Date d'enregsitrement",
        'created_at' => 'Créé le',
        'updated_at' => 'Mis à jour le',
        'selecter'=>[
            'select_couverture_medical_id'=>'Sélectionner la couverture médicale',
            'select_type_handicap_id'=>"Déterminer le type d'handicapé",
        ],
    ],
    'OrientationExterne' => 'Ce dossier est en cours d\'orientation externe',
    'enconsultation' => 'Ce dossier est en consultation ou en rendez-vous'


];
