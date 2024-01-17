<?php

namespace App\Repositories;

use App\Models\DossierPatient;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class DossierPatientRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'patient_id',
        'couverture_medical_id',
        'numero_dossier',
        'etat',
        'date_enregsitrement'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return DossierPatient::class;
    }
    public function create(array $input): Model
    {
        if (auth()->check()) {
            $input['user_id'] = auth()->user()->id;
        } 
        return parent::create($input);
    }
}
