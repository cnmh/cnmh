<?php

namespace App\Repositories\EntretienSocial;

use App\Models\DossierPatient;
use App\Repositories\BaseRepository;
use App\Models\EtatCivil;
use App\Models\NiveauScolaire;
use App\Models\Service;
use App\Models\TypeHandicap;
use App\Models\CouvertureMedical;
use App\Models\Patient;
use App\Models\Tuteur;
use App\Models\RendezVous;
use App\Models\DossierPatient_typeHandycape;
use App\Models\Dossier_patient_service;
use App\Models\DossierPatientConsultation;
use App\Models\Consultation;
use App\Models\OrientationExterne;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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

   
    public function entretienSocial($enquette, $patientID) {
        $enquette['patient_id'] = $patientID;
        $enquette['user_id'] = Auth::id(); 
        $dossierPatient = $this->model->create($enquette); 
        $typeHandycapeIDs = $enquette['type_handicap_id'];
        $serviceIDs = $enquette['services_id'];
        $this->AffecterTypeHandicapAuDossier($typeHandycapeIDs, $dossierPatient->id);
        $this->AffecterServiceAuDossier($serviceIDs, $dossierPatient->id);
    
        // Ajouter dossier en liste d'attente
        $date_enregsitrement = $enquette['date_enregsitrement'];
        $this->AjouterDossierEnListAttente($date_enregsitrement, $dossierPatient->id);
    }

    public function NumeroDossier(){
        return DossierPatient::where('numero_dossier', 'like', 'A-%')
        ->whereRaw('CAST(SUBSTRING(numero_dossier, 3) AS SIGNED) IS NOT NULL')
        ->max('numero_dossier');
    }


    public function DossierExiste($patientID){
        return DossierPatient::where('patient_id',$patientID)->first();
    }
    

     // Ajouter dossier patient type handicap
    public function AffecterTypeHandicapAuDossier($typeHandycapeIDs,$dossierPatientID){
        foreach ($typeHandycapeIDs as $typeHandycapeID) {
            $DossierPatient_typeHandycape = new DossierPatient_typeHandycape;
            $DossierPatient_typeHandycape->type_handicap_id = $typeHandycapeID;
            $DossierPatient_typeHandycape->dossier_patient_id = $dossierPatientID;
            $DossierPatient_typeHandycape->save();
        }
    }

    // Ajouter dossier patient service demander
    public function AffecterServiceAuDossier($service_ids,$dossierPatientID){

        foreach($service_ids as $service_id){
            $service_patient_demander = new Dossier_patient_service;
            $service_patient_demander->service_id = $service_id;
            $service_patient_demander->dossier_patient_id = $dossierPatientID;
            $service_patient_demander->save();
        }
    }

    // Ajouter consultation
    public function AjouterDossierEnListAttente($date_enregsitrement,$dossierPatientID){
        $consultation = new Consultation();
        $consultation->date_enregistrement=$date_enregsitrement;
        $consultation->type="medecinGeneral";
        $consultation->etat=Consultation::ETAT_EN_ATTENTE;
        $consultation->save();
        $consultationID = $consultation->id;
        $this->dossierPatientConsultation($dossierPatientID,$consultationID);
    }

    // Ajouter dossier patient consultation
    public function dossierPatientConsultation($dossierPatientID,$consultationID){
        $DossierPatient_consultation =  new DossierPatientConsultation;
        $DossierPatient_consultation->dossier_patient_id = $dossierPatientID;
        $DossierPatient_consultation->consultation_id  = $consultationID;
        $DossierPatient_consultation->save();
    }


    public function search($search){
        DossierPatient::join('patients', function ($join) {
            $join->on('dossier_patients.patient_id', '=', 'patients.id')
                ->select('patients.id as patientID', 'patients.*', 'dossier_patients.numero_dossier as dossier_id');
        })
        ->where('patients.nom', 'like', '%' . $search . '%')
        ->orWhere('dossier_patients.numero_dossier', 'like', '%' . $search . '%')->orderBy('dossier_patients.numero_dossier')
        ->paginate();
    }

    public function DossierPatient_typeHandycapFIND($dossierPatientID){
        return DossierPatient_typeHandycape::where('dossier_patient_id',$dossierPatientID)->get();
    }

    public function DossierPatient_serviceFIND($dossierPatientID){
        return Dossier_patient_service::where('dossier_patient_id',$dossierPatientID)->get();
    }

    public function DossierPatient_consultationFIND($dossierPatientID){
        return DossierPatientConsultation::where('dossier_patient_id',$dossierPatientID)->first();
    }

    public function ListAttenteFIND($id){
        return Consultation::where('id',$id)->where('etat','enAttente')->get();
    }

    public function ConsultationNedecinFIND($id){
        return Consultation::where('id',$id)->where('etat','enConsultation')->get();
    }

    public function rendezVousPatient(){

        return RendezVous::join('consultations', 'consultations.id', '=', 'rendez_vous.consultation_id')
        ->join('dossier_patient_consultation', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
        ->join('dossier_patients', 'dossier_patients.id', '=', 'dossier_patient_consultation.dossier_patient_id')
        ->join('patients', 'patients.id', '=', 'dossier_patients.patient_id')
        ->select([
            'rendez_vous.date_rendez_vous',
            'rendez_vous.etat as etatRendezVous',
            'consultations.*',
            'dossier_patient_consultation.*',
            'dossier_patients.*',
            'patients.*'
        ])
        ->get();

    }

    public function typeHandycapDossierPatientIfExisteDelete($dossierPatientID,$typeHandicapIDs){
        return DossierPatient_typeHandycape::where('dossier_patient_id', $dossierPatientID)
        ->whereNotIn('type_handicap_id', $typeHandicapIDs)
        ->delete();
    }

    public function typeHandycapDossierPatientUpdate($dossierPatientID,$typeHandicapID){
        return DossierPatient_typeHandycape::updateOrCreate(
            ['dossier_patient_id' => $dossierPatientID, 'type_handicap_id' => $typeHandicapID],
            ['type_handicap_id' => $typeHandicapID]
        );
    }

    public function serviceDossierPatientIfExisteDelete($dossierPatientID,$service_ids){
        return Dossier_patient_service::where('dossier_patient_id',$dossierPatientID)
        ->whereNotIn('service_id',$service_ids)
        ->delete();
    }

    public function serviceDossierPatientUpdate($dossierPatientID,$service_id){
        return Dossier_patient_service::updateOrCreate(
            ['dossier_patient_id' =>$dossierPatientID, 'service_id' => $service_id],
            ['service_id' => $service_id]
        );
    }

    public function OrientationExterneFIND($dossierPatientID){
        return OrientationExterne::where('dossier_patient_id', $dossierPatientID)->first();
    }

    public function ConsultationFIND($consultation){
        return Consultation::find($consultation);
    }

    public function deleteDossierPatientConsultation($input){
        $id = $input;
        $findDossierPatientConsultation = DossierPatientConsultation::where('dossier_patient_id',$id)->first();
        $delete =  $findDossierPatientConsultation->delete();
        return $delete;
    }

    public function deleteDossierPatient_typeHandycape($input){
        $id = $input;
        $findDossierPatient_typeHandycape = DossierPatient_typeHandycape::where('dossier_patient_id',$id)->first();
        $delete =  $findDossierPatient_typeHandycape->delete();
        return $delete;
    }

    public function deleteDossierFromListAttente($input){
        $id = $input;
        $findConsultation = Consultation::find($id);
        $delete =  $findConsultation->delete();
        return $delete;
    }

    public function deleteDossierPatient_service($input){
        $id = $input;
        $findDossier_patient_service = Dossier_patient_service::where('dossier_patient_id',$id)->first();
        $delete =  $findDossier_patient_service->delete();
        return $delete;
    }


    public function model(): string
    {
        return DossierPatient::class;
    }
}
