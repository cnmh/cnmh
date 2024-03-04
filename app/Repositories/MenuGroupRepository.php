<?php

namespace App\Repositories;

use App\Models\MenuGroup;
use App\Repositories\BaseRepository;

class MenuGroupRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'description',
        'icon'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return MenuGroup::class;
    }
}
