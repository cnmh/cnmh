<?php

namespace App\Repositories;

use App\Models\OrientationExterne;
use App\Repositories\BaseRepository;

class OrientationExterneRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'dossier_patient_id',
        'service_id',
        'objet',
        'description',
        'date_orientation'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return OrientationExterne::class;
    }
}
