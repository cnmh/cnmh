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
use App\Repositories\Consultation\ConsultationOrthophonisteRepository;
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
        $SocialType = Consultation::SocialType();

        if ($request->ajax()) {
            $search = $request->get('query');
            if($search != ""){
                $search = str_replace(" ", "%", $search);
                if($SocialType != ''){
                    $consultations = $this->consultationRepository->searchListAttente($search,$type);
                }else{
                    $consultations = $this->consultationRepository->search($search,$type);
                }
            }
            return view('PoleMedical.consultations.table',compact('consultations'))->render();
        }

        if($SocialType === "Liste-d'attente"){
            $list_attent = new ConsultationRepository;
            $consultations = $list_attent->Consultation();
        }
        elseif($type === 'Médecin-général'){
            $consultationMedecinRepo = new ConsultationMedecinRepository;
            $consultations = $consultationMedecinRepo->Consultation($type);
        }elseif($type === 'Dentiste'){
            $consultationDentisteRepo = new ConsultationDentisteRepository;
            $consultations = $consultationDentisteRepo->Consultation($type);
        }elseif($type === 'Orthophoniste'){
            $consultationOrthophonisteRepo = new ConsultationOrthophonisteRepository;
            $consultations = $consultationOrthophonisteRepo->Consultation($type);
        }

        return view('PoleMedical.consultations.index', compact('consultations'));
    }

    public function list_rendezVous(Request $request){
        $type = Consultation::OrientationType();
        if($request->ajax()){
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);

            if($search !=""){
                $rendez_vous = $this->consultationRepository->searchRendezVous($search, $type);
            }

            return response()->json(['data' => $rendez_vous]);
        }

        if($type === 'Médecin-général'){
            $RendezVousMedecinRepo = new ConsultationMedecinRepository;
            $dossier_patients = $RendezVousMedecinRepo->ConsultationRendezVous($type);
        }elseif($type === 'Dentiste'){
            $RendezVousDentisteRepo = new ConsultationDentisteRepository;
            $dossier_patients = $RendezVousDentisteRepo->ConsultationRendezVous($type);
        }elseif($type === 'Orthophoniste'){
            $RendezVousOrthophonisteRepo = new ConsultationOrthophonisteRepository;
            $dossier_patients = $RendezVousOrthophonisteRepo->ConsultationRendezVous($type);
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
        $type_handicaps = $request->type_handicap_id;
        $dossier_patient_id = $request->dossier_patients;
        $consultationID = $request->consultation_id;
        $type = Consultation::OrientationType();
        if($type === 'Médecin-général'){
            $consultationMedecinRepo = new ConsultationMedecinRepository;
            $consultations = $consultationMedecinRepo->ConsultationUpdate($input);
            $orientation = $consultationMedecinRepo->ConsultationAjouter($services,$dossier_patient_id,$type);
            $consultationService = $consultationMedecinRepo->AjouterConsultationService($consultationID,$services);
            $consultationHandicap = $consultationMedecinRepo->AjouterConsultationHandicap($consultationID,$type_handicaps);
        }elseif($type === 'Dentiste'){
            $consultationDentisteRepo = new ConsultationDentisteRepository;
            $consultations = $consultationDentisteRepo->ConsultationUpdate($input);
            $orientation = $consultationDentisteRepo->ConsultationAjouter($services,$dossier_patient_id,$type);
            $consultationService = $consultationDentisteRepo->AjouterConsultationService($consultationID,$services);
            $consultationHandicap = $consultationDentisteRepo->AjouterConsultationHandicap($consultationID,$type_handicaps);
        }
        elseif($type === 'Orthophoniste'){
            $consultationOrthophonisteRepo = new ConsultationOrthophonisteRepository;
            $consultations = $consultationOrthophonisteRepo->ConsultationUpdate($input);
            $orientation = $consultationOrthophonisteRepo->ConsultationAjouter($services,$dossier_patient_id,$type);
            $consultationService = $consultationOrthophonisteRepo->AjouterConsultationService($consultationID,$services);
            $consultationHandicap = $consultationOrthophonisteRepo->AjouterConsultationHandicap($consultationID,$type_handicaps);
        }

        Flash::success(__('messages.saved', ['model' => __('models/consultations.singular')]));
        return redirect(route('consultations.list', $type));
    }

    // Form pour editer la consultation
    public function edit($type,$id){
        $consultation = $this->consultationRepository->find($id);

        $consultationID = $consultation->id;
        $dossierPatientConsultation = $this->consultationRepository->DossierPatientConsultationFind($consultationID,$type);
        $dossier_patient_id = $dossierPatientConsultation->dossier_patient_id;
        $type_handicap_patients = $this->consultationRepository->DossierPatient_typeHandycapeFind($dossier_patient_id);
        $type_handicap_ids = $type_handicap_patients->pluck('type_handicap_id')->toArray();
        $type_handicap_patients = $this->consultationRepository->Consultation_type_handicapFind($consultationID);    
        $service_patient = $this->consultationRepository->Consultation_service_patientFind($consultationID); 
        $services_ids = $service_patient->pluck('service_id')->toArray(); 
        $type_handicap_repo = new TypeHandicapRepository;
        $type_handicap = $type_handicap_repo->get();
        $services_repo = new ServiceRepository;
        $services = $services_repo->get();
        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));
            return redirect(route('consultations.list', $type));
        }

        return view('PoleMedical.consultations.edit', compact('consultation','type_handicap_ids','type_handicap','services','service_patient','services_ids','dossierPatientConsultation'));
    }

    // update consultation
    public function update(Request $request, $type,$id){

        $consultation = $this->consultationRepository->find($id);
        $typeHandicapIDs = $request->type_handicap_id;
        $service_ids = $request->services_id;

        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));
            return redirect(route('consultations.list'));
        }

        $type_handicap_patients = $this->consultationRepository->Consultation_type_handicapUpdate($id,$typeHandicapIDs); 
        $services_patients = $this->consultationRepository->Consultation_serviceUpdate($id,$service_ids);    
        $consultation = $this->consultationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/consultations.singular')]));
        return redirect()->route('consultations.list', $type);

    }


    public function show($type, $id)
    {
        $consultation = $this->consultationRepository->find($id);
        $consultation_service = $this->consultationRepository->Consultation_service_patientFind($id); 
        $type_handicap_consultation = $this->consultationRepository->Consultation_type_handicapFind($id);    

        foreach($consultation_service as $item){
            $service = new ServiceRepository;
            $service = $service->find($item->service_id);
            $consultation_service_patient[] = $service;
        }

        foreach($type_handicap_consultation as $handicap){
            $handicaps = new TypeHandicapRepository;
            $handicaps = $handicaps->find($handicap->type_handicap_id);
            $consultation_handicap_patient[] = $handicaps;
        }


        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));
            return redirect(route('consultations.list', $type));
        }

        if(empty($consultation_handicap_patient) || empty($consultation_service_patient)){
            return view('PoleMedical.consultations.show', compact("PoleMedical.consultation"));
        }

        return view('PoleMedical.consultations.show', compact("consultation","consultation_service_patient","consultation_handicap_patient"));
    }

    // Supprimer consultation
    public function destroy($type,$id){

        $type = Consultation::OrientationType();
        if($type === 'Médecin-général'){
            $consultationMedecinRepo = new ConsultationMedecinRepository;
            $consultations = $consultationMedecinRepo->ConsultationModifier($type,$id);
            $consultations_typeHandicap = $consultationMedecinRepo->ConsultationTypeHandicapDelete($id);
            $consultations_services = $consultationMedecinRepo->ConsultationServiceDelete($id);           
        }elseif($type === 'Dentiste'){
            $consultationDentisteRepo = new ConsultationDentisteRepository;
            $consultations = $consultationDentisteRepo->ConsultationModifier($type,$id);
            $consultations_typeHandicap = $consultationDentisteRepo->ConsultationTypeHandicapDelete($id);
            $consultations_services = $consultationDentisteRepo->ConsultationServiceDelete($id);    
        }
        elseif($type === 'Orthophoniste'){
            $consultationOrthophonisteRepo = new ConsultationOrthophonisteRepository;
            $consultations = $consultationOrthophonisteRepo->ConsultationModifier($type,$id);
            $consultations_typeHandicap = $consultationOrthophonisteRepo->ConsultationTypeHandicapDelete($id);
            $consultations_services = $consultationOrthophonisteRepo->ConsultationServiceDelete($id);    
        }

        Flash::success(__('messages.reporter', ['model' => __('models/consultations.singular')]));
        return redirect()->back();
    }

    

   
}
