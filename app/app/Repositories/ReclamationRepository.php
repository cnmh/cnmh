<?php

namespace App\Repositories;

use App\Models\Reclamation;
use App\Repositories\BaseRepository;

class ReclamationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'patients_id',
        'objet',
        'description',
        'remarques',
        'date_reclamation'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Reclamation::class;
    }
}
