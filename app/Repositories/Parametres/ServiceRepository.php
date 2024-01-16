<?php

namespace App\Repositories\Parametres;

use App\Models\Service;
use App\Repositories\BaseRepository;

class ServiceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function get(){
        return Service::all();
    }

    public function model(): string
    {
        return Service::class;
    }
}
