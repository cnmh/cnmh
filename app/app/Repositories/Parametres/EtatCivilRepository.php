<?php

namespace App\Repositories\Parametres;

use App\Models\EtatCivil;
use App\Repositories\BaseRepository;

class EtatCivilRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return EtatCivil::class;
    }
}
