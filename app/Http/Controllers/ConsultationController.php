<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Consultation;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\RendezVous;
use App\Models\DossierPatient_typeHandycape;
use App\Models\TypeHandicap;
use App\Models\Service;
use App\Models\Consultation_service;
use App\Repositories\ConsultationRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Eloquent\Model;

class ConsultationController extends AppBaseController
{
    /** @var ConsultationRepository $consultationRepository*/
    private $consultationRepository;

    public function __construct(ConsultationRepository $consultationRepo)
    {
        $this->consultationRepository = $consultationRepo;
    }

    /**
     * Display a listing of the Consultation.
     */
    public function index(Request $request, $modelName)
    {

        if(ucFirst($modelName) == "MedecinGeneral"){
            $titleApp = "médecin généraliste";
        }elseif (ucFirst($modelName) == "Liste-attente") {
            $titleApp = "Liste d'attente";
        }elseif (ucFirst($modelName) == "Dentiste") {
            $titleApp = "dentiste";
        }


        $title = $modelName;
        $title  = ucFirst($title);

            $consultations = DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
            ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
            ->join('patients', 'dossier_patients.id', '=', 'patients.id')
             ->where([
                ["consultations.type","medecinGeneral"]
             ])
            ->select('*')
            ->paginate(1);

    
        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
        
            $consultations = DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
            ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
            ->join('patients', 'dossier_patients.id', '=', 'patients.id')
            ->where('patients.nom', 'like', '%' . $search . '%')
            ->orWhere('patients.prenom', 'like', '%' . $search . '%')
            ->orWhere('consultations.etat', 'like', '%' . $search . '%')->paginate(1);
                
        
            return view('consultations.table',compact('consultations', 'title',"titleApp"))->render();
        }
        return view('consultations.index', compact('consultations', 'title',"titleApp"));

    }

    

    /**
     * Show the form for creating a new Consultation.
     */
    public function create(Request $request, $model)
    {
        $title = $model;
    
        $consultationID = $request->get('consultation_id');
    
        $dossierPatientConsultation = DossierPatientConsultation::where('consultation_id', $consultationID)->first();
    
        $type_handicap_patients = DossierPatient_typeHandycape::where('dossier_patient_id', $dossierPatientConsultation->dossier_patient_id)->get();
    
        $type_handicap_ids = $type_handicap_patients->pluck('type_handicap_id')->toArray();
    
        $type_handicap = TypeHandicap::all();

        $services = Service::all();
    
        return view('consultations.create', compact('title', 'type_handicap_ids', 'type_handicap', 'services'));
    }
    

    /**
     * Store a newly created Consultation in storage.
     */
    public function store(CreateConsultationRequest $request, $model)
    {

        $input = $request->all();

        $typeHandicapIDs = $request->type_handicap_id;
        $service_ids = $request->services_id;
        $consultationID = $request->consultation_id;

        foreach($service_ids as $service_id){
            $service = new Consultation_service;
            $service->service_id = $service_id;
            $service->consultation_id = $consultationID;
            $service->save();
        }

        $dossierPatientConsultation = DossierPatientConsultation::where('consultation_id', $consultationID)->first();

        DossierPatient_typeHandycape::where('dossier_patient_id', $dossierPatientConsultation->dossier_patient_id)
        ->whereNotIn('type_handicap_id', $typeHandicapIDs)
        ->delete();

        foreach ($typeHandicapIDs as $typeHandicapID) {
            DossierPatient_typeHandycape::updateOrCreate(
                ['dossier_patient_id' =>$dossierPatientConsultation->dossier_patient_id, 'type_handicap_id' => $typeHandicapID],
                ['type_handicap_id' => $typeHandicapID]
            );
        }

        $Model = "App\\Models\\" . ucfirst($model);
        $callModel = new $Model;
        $consultation= $callModel::find($request->consultation_id)->update([
            "date_enregistrement" => $request->date_enregistrement,
            "date_consultation" =>$request->date_consultation,
            "consultation_id" => $request->consultation_id,
            "observation" => $request->observation,
            "diagnostic" => $request->diagnostic,
            "bilan" => $request->bilan,
            "etat"=>"enConsultation"
        ]);;
        // $consultation= $callModel::where('bilan',$input["bilan"])->get();







        // $consultation = $this->consultationRepository->create($input);

        // Flash::success(__('messages.saved', ['model' => __('models/consultations.singular')]));

        return redirect(route('consultations.index', $model));
    }

    /**
     * Display the specified Consultation.
     */
    public function show($model, $id)
    {
        $title = $model;

        $consultation = $this->consultationRepository->find($id);

        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));

            return redirect(route('consultations.index', $title));
        }

        return view('consultations.show', compact("consultation", "title"));
    }

    /**
     * Show the form for editing the specified Consultation.
     */
    public function edit($id)
    {
        $consultation = $this->consultationRepository->find($id);

        $consultationID = $consultation->id;
    
        $dossierPatientConsultation = DossierPatientConsultation::where('consultation_id', $consultationID)->first();
    
        $type_handicap_patients = DossierPatient_typeHandycape::where('dossier_patient_id', $dossierPatientConsultation->dossier_patient_id)->get();
    
        $type_handicap_ids = $type_handicap_patients->pluck('type_handicap_id')->toArray();

        $consultation_service = Consultation_service::where('consultation_id',$consultationID)->get();

        $service_patient = $consultation_service->pluck('service_id')->toArray();
    
        $type_handicap = TypeHandicap::all();

        $services = Service::all();

        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));

            return redirect(route('consultations.index'));
        }

        return view('consultations.edit', compact('consultation','type_handicap_ids','type_handicap','services','service_patient'));
    }

    /**
     * Update the specified Consultation in storage.
     */
    public function update($id, UpdateConsultationRequest $request)
    {
        $consultation = $this->consultationRepository->find($id);

        $typeHandicapIDs = $request->type_handicap_id;
        $service_ids = $request->services_id;

        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));

            return redirect(route('consultations.index'));
        }

        $dossierPatientConsultation = DossierPatientConsultation::where('consultation_id', $consultation->id)->first();

        DossierPatient_typeHandycape::where('dossier_patient_id', $dossierPatientConsultation->dossier_patient_id)
        ->whereNotIn('type_handicap_id', $typeHandicapIDs)
        ->delete();

        foreach ($typeHandicapIDs as $typeHandicapID) {
            DossierPatient_typeHandycape::updateOrCreate(
                ['dossier_patient_id' =>$dossierPatientConsultation->dossier_patient_id, 'type_handicap_id' => $typeHandicapID],
                ['type_handicap_id' => $typeHandicapID]
            );
        }

        Consultation_service::where('consultation_id',$consultation->id)
        ->whereNotIn('service_id',$service_ids)
        ->delete();


        foreach($service_ids as $service_id){
            Consultation_service::updateOrCreate(
                ['consultation_id' =>$consultation->id, 'service_id' => $service_id],
                ['service_id' => $service_id]
            );
        }


        $consultation = $this->consultationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/consultations.singular')]));

        return redirect('/consultations/liste-attente');
    }

    /**
     * Remove the specified Consultation from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $consultation = $this->consultationRepository->find($id);

        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));

            return redirect(route('consultations.index'));
        }

        $this->consultationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/consultations.singular')]));

        return redirect()->back();
    }

    public function Ajouter_RendezVous(Request $request,$Model)
    {

        $dossier_patients = DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
        ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
        ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
        ->where("consultations.etat","enRendezVous")
        ->where("consultations.type",$Model)
        ->select('*')
        ->paginate();



        return view('consultations.rendezVous', compact("dossier_patients"));
    }

    public function patient(Request $request)
    {
        $dossier_patient = DossierPatient::find($request->dossier_patients);
        return view('consultations.patient',compact("dossier_patient"));
    }
}
