<?php

namespace App\Repositories\Consultation;

use App\Models\Consultation\ConsultationMedecin;
use App\Models\RendezVous;
use App\Repositories\BaseRepository;
use App\Models\DossierPatientConsultation;
use App\Models\Consultation\Consultation;
use App\Models\Service;
use App\Models\Consultation\Consultation_service;
use App\Models\Consultation\Consultation_type_handicap;
use Carbon\Carbon;


class ConsultationMedecinRepository extends BaseRepository
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

    public function Consultation($type){

        return DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
        ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
        ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
        ->where('consultations.type', $type)
        ->where('consultations.etat', '=', 'enConsultation')
        ->select(
            'dossier_patient_consultation.*',
            'consultations.id as consultation_id',
            'consultations.etat',
            'consultations.type',
            'consultations.date_consultation',
            'consultations.date_enregistrement',
            'patients.nom',
            'patients.prenom',
            'patients.telephone',
            'patients.id as patient_id',
            'dossier_patients.numero_dossier'
        )
        ->paginate();
    }

    public function ConsultationRendezVous($type){

        return  DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
        ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
        ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
        ->where("consultations.etat","enRendezVous")
        ->where("consultations.type",$type)
        ->select('*')
        ->paginate();
    }

    public function ConsultationUpdate($input)
    {
        $consultationID = $input['consultation_id'];        
        return ConsultationMedecin::find($consultationID)->update([
            "date_enregistrement" => $input['date_enregistrement'],
            "date_consultation" => $input['date_consultation'],
            "observation" => $input['observation'],
            "diagnostic" => $input['diagnostic'],
            "bilan" => $input['bilan'],
            "etat" => Consultation::ETAT_CONSULTATION
        ]);
    }


    public function ConsultationAjouter($input, $dossier_patient_id, $type)
{
    $now = Carbon::now();
    $consultations = [];

    foreach ($input as $serviceId) {
        $orientations = Service::where('id', $serviceId)->get();

        foreach ($orientations as $orientation) {
            $modelClass = 'App\\Models\\Consultation\\Consultation' . $orientation->nom;

            if (class_exists($modelClass)) {
                $model = new $modelClass();
                $consultation = $model->create([
                    'date_enregistrement' => $now,
                    'date_consultation' => null,
                    'observation' => null,
                    'diagnostic' => null,
                    'bilan' => null,
                    'etat' => Consultation::ETAT_EN_ATTENTE,
                ]);

                $consultationID = $consultation->id;
                $this->ajouterDossier_patient_consultation($consultationID, $dossier_patient_id);
                $consultations[] = $consultation;
            }
        }
    }

    return $consultations;
}

    

    public function ajouterDossier_patient_consultation($consultationID, $dossier_patient_id)
    {
        return DossierPatientConsultation::create([
            'dossier_patient_id' => $dossier_patient_id,
            'consultation_id' => $consultationID,
        ]);
    }


    public function AjouterConsultationService($consultationID, $input)
    {
        $service_ids = $input;
        
        foreach ($service_ids as $service_id) {
            $service = new Consultation_service;
            $service->service_id = $service_id;
            $service->consultation_id = $consultationID;
            $service->save();
        }
    
        return $consultationID; 
    }

    public function AjouterConsultationHandicap($consultationID, $input)
    {
        $typeHandicapIDs = $input;
        
        foreach ($typeHandicapIDs as $typeHandycapeID) {
            $consultation_typeHandycape = new Consultation_type_handicap;
            $consultation_typeHandycape->type_handicap_id = $typeHandycapeID;
            $consultation_typeHandycape->consultation_id = $consultationID;
            $consultation_typeHandycape->save();
        }

        return $consultationID;
    }

    public function ConsultationModifier($type,$id)
    {
        return ConsultationMedecin::find($id)->update([
            "date_consultation" => null,
            "observation" => null,
            "diagnostic" => null,
            "bilan" => null,
            'type' => $type,
            "etat" => Consultation::ETAT_EN_RENDEZVOUS
        ]);
    }

    public function ConsultationTypeHandicapDelete($id){

        $dossierPatient = DossierPatientConsultation::where('consultation_id',$id)->first();
        $allConsultation = Consultation_type_handicap::where('consultation_id',$dossierPatient->consultation_id)->get();
        foreach($allConsultation as $consultationHandicap){
            $consultationHandicap->delete();
        }
        return true;
        
    }

    public function ConsultationServiceDelete($id) {
        $dossierPatient = DossierPatientConsultation::where('consultation_id', $id)->first();

        $dossierPatient_id = $dossierPatient->dossier_patient_id;
        if (!$dossierPatient) {
        
            return false; 
        }
    
       
        $allConsultation = Consultation_service::where('consultation_id',$dossierPatient->consultation_id)->get();
    
        foreach ($allConsultation as $consultationService) {
            $consultationService->delete();
        }

      
        if ($dossierPatient) {            
            $dossierPatientConsultation = DossierPatientConsultation::where('dossier_patient_id', $dossierPatient_id)
                ->where('id', '!=', $dossierPatient->id) 
                ->get();
            
            foreach ($dossierPatientConsultation as $item) {
                $item->delete();
                $consultations = Consultation::find($item->consultation_id)->delete();
            }
        }
        
    }
    
    

    
    public function model(): string
    {
        return ConsultationMedecin::class;
    }
}
