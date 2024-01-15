<?php

namespace App\Repositories\EntretienSocial;

use App\Models\Tuteur;
use App\Repositories\BaseRepository;

class TuteurRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'etat_civil_id',
        'nom',
        'prenom',
        'sexe',
        'telephone',
        'email',
        'adresse',
        'cin',
        'remarques'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Tuteur::class;
    }
}
