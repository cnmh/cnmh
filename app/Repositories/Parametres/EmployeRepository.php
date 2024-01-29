<?php

namespace App\Repositories\Parametres;

use App\Models\Employe;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class EmployeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'date_naissance',
        'cin',
        'fonction_id',
        'date_embauche',
        'user_id',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Employe::class;
    }

}
