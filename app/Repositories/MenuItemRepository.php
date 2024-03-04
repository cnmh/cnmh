<?php

namespace App\Repositories;

use App\Models\MenuItem;
use App\Repositories\BaseRepository;

class MenuItemRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'description',
        'icon',
        'url',
        'reference',
        'visible',
        'menu_group_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return MenuItem::class;
    }
}
