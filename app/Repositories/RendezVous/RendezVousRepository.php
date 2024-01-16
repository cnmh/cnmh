<?php

namespace App\Repositories\RendezVous;

use App\Models\RendezVous;
use App\Models\Consultation;
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

    public function create(array $input)
    {
        $input['etat'] = RendezVous::RendezVousEtat();
        $rendezVous = parent::create($input);
        // Update consultation etat
        Consultation::find($input['consultation_id'])->update(['etat' => 'enRendezVous']);
        return $rendezVous;
    }

    public function model(): string
    {
        return RendezVous::class;
    }
}
