<?php

namespace App\Repositories;

use App\Models\Consultation;
use App\Repositories\BaseRepository;

class ConsultationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'date_enregistrement',
        'date_consultation',
        'observation',
        'diagnostic',
        'type',
        'bilan'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Consultation::class;
    }

    public function updateEtatConsultation($consultation)
    {
        // dd($consultation);
    
        // Update the 'etat' column to 'enRendezVous'
        $consultation->update(['etat' => 'enRendezVous']);

    }
}
