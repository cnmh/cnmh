<?php

namespace App\Http\Controllers\Consultation;

use App\Http\Requests\CreateConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Consultation\Consultation;
use App\Models\Consultation\ConsultationMedecin;

use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\RendezVous;
use App\Models\DossierPatient_typeHandycape;
use App\Models\Dossier_patient_service;
use App\Models\TypeHandicap;
use App\Models\Service;
use App\Models\Consultation\Consultation_service;
use App\Models\Consultation\Consultation_type_handicap;

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
use Illuminate\Support\Str;



class ConsultationController extends AppBaseController
{

    private $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepository)
    {
        $this->consultationRepository = $consultationRepository;
    }
   

    // List des consultations
    public function list_consultations(Request $request){


        $GetRepository = $this->getRepositorie($request->url());

        $type = Consultation::OrientationType();
        $consultationPath = $GetRepository;
        $consultations = $consultationPath->Consultation($type);

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
            return view('Consultations.table',compact('consultations'))->render();
        }

       

        return view('Consultations.index', compact('consultations'));
    }

    public function list_rendezVous(Request $request){

        $GetRepository = $this->getRepositorie($request->url());
        $type = Consultation::OrientationType();
        $consultationPath = $GetRepository;
        $dossier_patients = $consultationPath->ConsultationRendezVous($type);

        if($request->ajax()){
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
            if($search !=""){
                $rendez_vous = $this->consultationRepository->searchRendezVous($search, $type);
            }
            return response()->json(['data' => $rendez_vous]);
        }

        return view('Consultations.rendezVous', compact("dossier_patients"));
    }

    // Choissir le rendez-vous pour pouvoir d'ajoute un consultation
    public function SelectRendezVous(Request $request){

        if(empty($request->dossier_patient_id)){
            return back();
        }
        $dossier_patient_id = $request->dossier_patient_id;
        return redirect()->route('consultations.patientInformation', [
            'dossier_patient_id' => $dossier_patient_id
        ]);
    }


    // Affichage des informations de patient
    public function InformationPatient($dossier_patient_id){
        $type = Consultation::OrientationType();
        $dossier_patient = $this->consultationRepository->DossierPatientFind($dossier_patient_id);
        $dossier_patient_consultation = $this->consultationRepository->DossierPatientInfoFind($dossier_patient_id,$type);
        $consultation_id = $dossier_patient_consultation->consultation_id;
        return view('Consultations.patient',compact("dossier_patient","consultation_id"));
    }

    // Form pour ajouter la consultation
    public function FormAjouterConsultation(Request $request){
        $type = Consultation::OrientationType();
        $consultationID = $request->consultation_id;
        $dossier_patient_id = $request->dossier_patient_id;
        $dossierPatientConsultation = $this->consultationRepository->DossierPatientInfoFind($dossier_patient_id,$type);
        $type_handicap_patients = $this->consultationRepository->DossierPatient_typeHandycapeFind($dossier_patient_id);
        $type_handicap_ids = $type_handicap_patients->pluck('type_handicap_id')->toArray();
        $type_handicap_repo = new TypeHandicapRepository;
        $type_handicap = $type_handicap_repo->get();
        $service_patient = $this->consultationRepository->Dossier_patient_serviceFind($dossier_patient_id);
        $services_ids = $service_patient->pluck('service_id')->toArray();
        $services_repo = new ServiceRepository;
        $services = $services_repo->get();
        return view('Consultations.create', compact('type_handicap_ids', 'type_handicap', 'services', 'services_ids', 'service_patient','dossierPatientConsultation'));
    }

    // Ajouter la consultation
    public function AjouterConsultation(Request $request){

        $input = $request->all();
        $GetRepository = $this->getRepositorie($request->url());
        $consultationPath = $GetRepository;
        $type = Consultation::OrientationType();
        $services = $request->services_id;
        $type_handicaps = $request->type_handicap_id;
        $dossier_patient_id = $request->dossier_patients;
        $consultationID = $request->consultation_id;
        if($type === 'Médecin-général'){
            $orientation = $consultationPath->ConsultationAjouter($services,$dossier_patient_id,$type);
            $consultationService = $consultationPath->AjouterConsultationService($consultationID,$services);
            $consultationHandicap = $consultationPath->AjouterConsultationHandicap($consultationID,$type_handicaps);
        }
        $consultations = $consultationPath->ConsultationUpdate($input);
        Flash::success(__('messages.saved', ['model' => __('models/consultations.singular')]));
        return redirect(route('consultations.list', $type));
    }

    // Form pour editer la consultation
    public function edit(Request $request, $id){
        $consultation = $this->consultationRepository->find($id);
        $type = Consultation::OrientationType();
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
        $GetRepository = $this->getRepositorie($request->url());
        $consultationPath = $GetRepository;
        $seance = $consultationPath->seanceEdit($consultationID);
        $nombreSeance = count($seance);
        $existingSeanceDates = array_map(function ($item) {
            return $item->date_rendez_vous->format('Y-m-d');
        }, $seance);

        return view('Consultations.edit', compact('consultation', 'type_handicap_ids', 'type_handicap', 'services', 'service_patient', 'services_ids', 'dossierPatientConsultation', 'type_handicap_patients', 'seance', 'nombreSeance', 'existingSeanceDates'));
    }

    // update consultation
    public function update(Request $request,$id){

        $consultation = $this->consultationRepository->find($id);
        $typeHandicapIDs = $request->type_handicap_id;
        $service_ids = $request->services_id;

        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));
            return redirect(route('consultations.list'));
        }


        $type = Consultation::OrientationType();

        if($type === "Médecin-général"){
            $type_handicap_patients = $this->consultationRepository->Consultation_type_handicapUpdate($id,$typeHandicapIDs); 
            $services_patients = $this->consultationRepository->Consultation_serviceUpdate($id,$service_ids);  
        }

        $data = [
            "date_enregistrement" => $request->date_enregistrement,
            "date_consultation" => $request->date_consultation,
            "consultation_id" => $request->consultation_id,
            "observation" => $request->observation,
            "diagnostic" => $request->diagnostic,
            "bilan" => $request->bilan,
            "dossier_patients" => $request->dossier_patients
        ];

        $consultation = $this->consultationRepository->update($data, $id);
        $seance = $this->consultationRepository->updateSeance($request->all(), $id); 

        Flash::success(__('messages.updated', ['model' => __('models/consultations.singular')]));
        return redirect()->route('consultations.list');

    }


    public function show($id)
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
            return redirect(route('consultations.list'));
        }

        if(empty($consultation_handicap_patient) || empty($consultation_service_patient)){
            return view('Consultations.show', compact("consultation"));
        }

        return view('Consultations.show', compact("consultation","consultation_service_patient","consultation_handicap_patient"));
    }

    public function seance(Request $request){

        $GetRepository = $this->getRepositorie($request->url());
        $type = Consultation::OrientationType();
        $consultationPath = $GetRepository;

        if($request->ajax()){
            $search = $request->get('searchValue');
            if($search != ""){
                $search = str_replace(" ", "%", $search);
                $seance = $consultationPath->searchData($search,$type);
            }
            return view('Consultations.seance',compact('seance'))->render();
        }

        $seance = $consultationPath->seance($type);

        return view('Consultations.seance', compact("seance"));
    }

    // Supprimer consultation
    public function destroy(Request $request,$id){

        $GetRepository = $this->getRepositorie($request->url());
        $consultationPath = $GetRepository;
        $type = Consultation::OrientationType();
        $consultations = $consultationPath->ConsultationModifier($type,$id);
        if($type === "Médecin-général"){
            $consultations_typeHandicap = $consultationPath->ConsultationTypeHandicapDelete($id);
            $consultations_services = $consultationPath->ConsultationServiceDelete($id); 

        }
                 
        Flash::success(__('messages.reporter', ['model' => __('models/consultations.singular')]));
        return redirect()->back();
    }

    public function presentSeance(Request $request, $id){
        $GetRepository = $this->getRepositorie($request->url());
        $consultationPath = $GetRepository;
        $etat = "Présent";
        $seance = $consultationPath->seanceUpdate($etat,$id);
        Flash::success(__('messages.updated', ['model' => __('models/seance.singular')]));
        return back();
    }

    public function absentSeance(Request $request, $id){
        $GetRepository = $this->getRepositorie($request->url());
        $consultationPath = $GetRepository;
        $etat = "Absent";
        $seance = $consultationPath->seanceUpdate($etat,$id);
        Flash::success(__('messages.updated', ['model' => __('models/seance.singular')]));
        return back();
    }

    private function getRepositorie($request){
        $route = $request;
        $type = explode('/',$route);
        $model = urldecode($type[3]); 


        if($model === "Médecin-général"){
            $modelRepository = 'ConsultationMedecinRepository';
        } else {
            $modelRepository = 'Consultation'.ucfirst($model).'Repository'; 
        }
        $path = "\\App\\Repositories\\Consultation\\".$modelRepository;   
        
        if($model === 'Médecin-général'){
            $repository = new $path(new ConsultationMedecin);
        }else{
            $repository = new $path(new Consultation.$model);
        }
        return $repository;
    }

   
    
}
