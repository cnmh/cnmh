<?php

namespace App\Repositories\Consultation;

use App\Models\Consultation;
use App\Repositories\BaseRepository;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\DossierPatient_typeHandycape;
use App\Models\Dossier_patient_service;



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

    public function DossierPatientFind($id){
        return DossierPatient::find($id);
    }

    public function DossierPatientConsultationFind($id, $type)
    {
        return DossierPatientConsultation::where('dossier_patient_id', $id)
            ->whereHas('consultation', function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->first();
    }
    

    public function DossierPatient_typeHandycapeFind($id){
        return DossierPatient_typeHandycape::where('dossier_patient_id', $id)->get();
    }

    public function Dossier_patient_serviceFind($id){
        return Dossier_patient_service::where('dossier_patient_id', $id)->get();
    }

    public function search($search, $type)
    {
        return DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
            ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
            ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
            ->select('*', 'patients.id as patient_id')
            ->where(function ($query) use ($search) {
                $query->where('patients.nom', 'like', '%' . $search . '%')
                    ->orWhere('patients.prenom', 'like', '%' . $search . '%');
            })
            ->where('consultations.etat', '=', 'enConsultation')
            ->where('consultations.type', '=', $type)
            ->paginate();
    }
    
    public function model(): string
    {
        return Consultation::class;
    }
}
