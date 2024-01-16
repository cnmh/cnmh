<?php

namespace App\Repositories\Parametres;

use App\Models\CouvertureMedical;
use App\Repositories\BaseRepository;

class CouvertureMedicalRepository extends BaseRepository
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
        return CouvertureMedical::all();
    }

    public function model(): string
    {
        return CouvertureMedical::class;
    }
}
