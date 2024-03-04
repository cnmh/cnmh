<?php

namespace App\Repositories;

use App\Models\RendezVous;
use App\Repositories\BaseRepository;

class RendezVousRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id_consultation',
        'date_rendez_vous',
        'etat',
        'remarques'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return RendezVous::class;
    }
}
