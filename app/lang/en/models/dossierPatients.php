<?php

return [
    'singular' => 'Patient File',
    'plural' => 'Patient Files',
    'fields' => [
        'id' => 'ID',
        'patient_id' => 'Patient ID',
        'couverture_medical_id' => 'Medical Coverage',
        'type_handicap_id' => 'Type of handicap',
        'numero_dossier' => 'File Number',
        'etat' => 'Status',
        'date_enregsitrement' => 'Registration Date',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'selecter' => [
            'select_couverture_medical_id' => 'Select Medical Coverage',
            'select_type_handicap_id' => 'Select Type of Handicap',
        ],
    ],
];
