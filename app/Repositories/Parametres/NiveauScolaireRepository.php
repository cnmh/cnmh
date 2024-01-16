<?php

namespace App\Repositories\Parametres;

use App\Models\NiveauScolaire;
use App\Repositories\BaseRepository;

class NiveauScolaireRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function all(){
        return NiveauScolaire::all();
    }

    public function model(): string
    {
        return NiveauScolaire::class;
    }
}
