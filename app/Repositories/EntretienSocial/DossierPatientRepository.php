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
use App\Models\DossierPatient_typeHandycape;
use App\Models\Dossier_patient_service;
use App\Models\DossierPatientConsultation;
use App\Models\Consultation;
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
        $consultation->etat=Consultation::ConsultationEtat();
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

    public function model(): string
    {
        return DossierPatient::class;
    }
}
