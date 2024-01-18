<?php

namespace App\Http\Controllers\PoleMedical;

use App\Http\Requests\CreateConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Consultation;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\RendezVous;
use App\Models\DossierPatient_typeHandycape;
use App\Models\Dossier_patient_service;
use App\Models\TypeHandicap;
use App\Models\Service;
use App\Models\Consultation_service;
use App\Models\Consultation_type_handicap;

use App\Repositories\Consultation\ConsultationRepository;
use App\Repositories\Consultation\ConsultationMedecinRepository;
use App\Repositories\Consultation\ConsultationDentisteRepository;

use App\Repositories\Parametres\TypeHandicapRepository;
use App\Repositories\Parametres\ServiceRepository;


use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportConsultation;
use App\Imports\ImportConsultation;
use Illuminate\Support\Facades\Auth;



class ConsultationController extends AppBaseController
{

    private $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepository)
    {
        $this->consultationRepository = $consultationRepository;
    }
   

    // List des consultations
    public function list_consultations(Request $request){

        $type = Consultation::OrientationType();

        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
            $consultations = $this->consultationRepository->search($search,$type);
            return view('PoleMedical.consultations.table',compact('consultations'))->render();
        }

        if($type === 'Médecin-général'){
            $consultationMedecinRepo = new ConsultationMedecinRepository;
            $consultations = $consultationMedecinRepo->Consultation($type);
        }elseif($type === 'Dentiste'){
            $consultationDentisteRepo = new ConsultationDentisteRepository;
            $consultations = $consultationDentisteRepo->Consultation($type);
        }

        return view('PoleMedical.consultations.index', compact('consultations'));
    }

    public function list_rendezVous(){

        $type = Consultation::OrientationType();
        if($type === 'Médecin-général'){
            $RendezVousMedecinRepo = new ConsultationMedecinRepository;
            $dossier_patients = $RendezVousMedecinRepo->ConsultationRendezVous($type);
        }elseif($type === 'Dentiste'){
            $RendezVousDentisteRepo = new ConsultationDentisteRepository;
            $dossier_patients = $RendezVousDentisteRepo->ConsultationRendezVous($type);
        }

        return view('PoleMedical.consultations.rendezVous', compact("dossier_patients"));
    }

    // Choissir le rendez-vous pour pouvoir d'ajoute un consultation
    public function SelectRendezVous(Request $request){

        if(empty($request->dossier_patient_id)){
            return back();
        }
        $dossier_patient_id = $request->dossier_patient_id;
        return redirect()->route('consultations.patientInformation', [
            'type' => \App\Models\Consultation::OrientationType(),
            'dossier_patient_id' => $dossier_patient_id
        ]);
    }


    // Affichage des informations de patient
    public function InformationPatient($type,$dossier_patient_id){
        $type = Consultation::OrientationType();
        $dossier_patient = $this->consultationRepository->DossierPatientFind($dossier_patient_id);
        $dossier_patient_consultation = $this->consultationRepository->DossierPatientConsultationFind($dossier_patient_id,$type);
        $consultation_id = $dossier_patient_consultation->consultation_id;
        return view('PoleMedical.consultations.patient',compact("dossier_patient","consultation_id"));
    }

    // Form pour ajouter la consultation
    public function FormAjouterConsultation(Request $request){
        $type = Consultation::OrientationType();
        $consultationID = $request->consultation_id;
        $dossier_patient_id = $request->dossier_patient_id;
        $dossierPatientConsultation = $this->consultationRepository->DossierPatientConsultationFind($dossier_patient_id,$type);
        $type_handicap_patients = $this->consultationRepository->DossierPatient_typeHandycapeFind($dossier_patient_id);
        $type_handicap_ids = $type_handicap_patients->pluck('type_handicap_id')->toArray();
        $type_handicap_repo = new TypeHandicapRepository;
        $type_handicap = $type_handicap_repo->get();
        $service_patient = $this->consultationRepository->Dossier_patient_serviceFind($dossier_patient_id);
        $services_ids = $service_patient->pluck('service_id')->toArray();
        $services_repo = new ServiceRepository;
        $services = $services_repo->get();
        return view('PoleMedical.consultations.create', compact('type_handicap_ids', 'type_handicap', 'services', 'services_ids', 'service_patient','dossierPatientConsultation'));
    }

    // Ajouter la consultation
    public function AjouterConsultation(Request $request){

        $input = $request->all();
        $services = $request->services_id;
        $dossier_patient_id = $request->dossier_patients;
        $type = Consultation::OrientationType();
        if($type === 'Médecin-général'){
            $consultationMedecinRepo = new ConsultationMedecinRepository;
            $consultations = $consultationMedecinRepo->ConsultationUpdate($input);
            $orientation = $consultationMedecinRepo->ConsultationAjouter($services,$dossier_patient_id,$type);
        }elseif($type === 'Dentiste'){
            $consultationDentisteRepo = new ConsultationDentisteRepository;
            $consultations = $consultationDentisteRepo->ConsultationUpdate($input);
            $orientation = $consultationDentisteRepo->ConsultationAjouter($services,$dossier_patient_id,$type);
        }

        Flash::success(__('messages.saved', ['model' => __('models/consultations.singular')]));
        return redirect(route('consultations.list', $type));
    }

    // Form pour editer la consultation
    public function edit($id){

    }

    // update consultation
    public function update(Request $request, $id){

    }

    // Supprimer consultation
    public function destroy($id){

    }

    

   
}
