<?php

namespace App\Repositories\Consultation;

use App\Models\Consultation\Consultation;
use App\Repositories\BaseRepository;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\DossierPatient_typeHandycape;
use App\Models\Dossier_patient_service;
use App\Models\Consultation\Consultation_type_handicap;
use App\Models\Consultation\Consultation_service;
use App\Models\RendezVous;
use App\Models\Consultation\Seance;


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

        return DossierPatientConsultation::where('consultation_id', $id)
            ->whereHas('consultation', function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->first();
    }

    public function DossierPatientInfoFind($id, $type)
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
            ->paginate(2);
    }

    public function searchRendezVous($search,$type)
    {
        return DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
            ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
            ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
            ->select('*', 'patients.id as patient_id')
            ->where(function ($query) use ($search) {
                $query->where('patients.nom', 'like', '%' . $search . '%')
                    ->orWhere('patients.prenom', 'like', '%' . $search . '%');
            })
            ->where('consultations.etat', '=', 'enRendezVous')
            ->where('consultations.type', '=', $type)
            ->get();
    }

    

    public function Consultation_type_handicapFind($id){
        return Consultation_type_handicap::where('consultation_id', $id)->get();
    }

    public function Consultation_service_patientFind($id){
        return Consultation_service::where('consultation_id', $id)->get();
    }

    public function Consultation_type_handicapUpdate($id, $typeHandicapIDs){
        Consultation_type_handicap::where('consultation_id',$id)
        ->whereNotIn('type_handicap_id', $typeHandicapIDs)
        ->delete();

        foreach ($typeHandicapIDs as $typeHandicapID) {
            Consultation_type_handicap::updateOrCreate(
                ['consultation_id' => $id, 'type_handicap_id' => $typeHandicapID],
                ['type_handicap_id' => $typeHandicapID]
            );
        }

        return true;
    }

    public function Consultation_serviceUpdate($id, $service_ids){
        Consultation_service::where('consultation_id',$id)
        ->whereNotIn('service_id',$service_ids)
        ->delete();

        foreach($service_ids as $service_id){
            Consultation_service::updateOrCreate(
                ['consultation_id' =>$id, 'service_id' => $service_id],
                ['service_id' => $service_id]
            );
        }

        return true;
    }

    public function Consultation(){

        return DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
        ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
        ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
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


    public function updateSeance($data, $id)
    {
        $consultationID = $id;
        for ($i = 1; $i <= $data['nombre_seance']; $i++) {
            $dateSeanceKey = 'date_seance' . $i;
            if (isset($data[$dateSeanceKey])) {
                $dateSeance = $data[$dateSeanceKey];
    
                $rendezVous = RendezVous::where('consultation_id', $consultationID)
                    ->where('date_rendez_vous', $dateSeance)
                    ->first();
    
                if ($rendezVous) {
                    $seance = Seance::where('rendezVous_id', $rendezVous->id)
                        ->where('consultation_id', $consultationID)
                        ->first();
    
                    if ($seance) {
                        $seance->etat = '';
                        $seance->save();
                    } else {
                        $seance = new Seance();
                        $seance->consultation_id = $consultationID;
                        $seance->rendezVous_id = $rendezVous->id;
                        $seance->etat = '';
                        $seance->save();
                    }
                } else {
                    $rendezVous = new RendezVous();
                    $rendezVous->date_rendez_vous = $dateSeance;
                    $rendezVous->consultation_id = $consultationID;
                    $rendezVous->etat = 'Planifier';
                    $rendezVous->save();
    
                    $seance = new Seance();
                    $seance->consultation_id = $consultationID;
                    $seance->rendezVous_id = $rendezVous->id;
                    $seance->etat = '';
                    $seance->save();
                }
            }
        }
    }





    

    
    public function model(): string
    {
        return Consultation::class;
    }
}
