<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Consultation;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\RendezVous;
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
            ->paginate();

       


       
        //  $consultations = $this->consultationRepository->where($model,'type',$modelName)->paginate();
        if ($request->ajax()) {
            return view('consultations.table')
                ->with('consultations', $consultations);
        }
        return view('consultations.index', compact('consultations', 'title',"titleApp"));

    }

    

    /**
     * Show the form for creating a new Consultation.
     */
    public function create($model)
    {
        $title = $model;
        return view('consultations.create', compact('title'));
    }

    /**
     * Store a newly created Consultation in storage.
     */
    public function store(CreateConsultationRequest $request, $model)
    {

        $input = $request->all();


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

        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));

            return redirect(route('consultations.index'));
        }

        return view('consultations.edit')->with('consultation', $consultation);
    }

    /**
     * Update the specified Consultation in storage.
     */
    public function update($id, UpdateConsultationRequest $request)
    {
        $consultation = $this->consultationRepository->find($id);

        if (empty($consultation)) {
            Flash::error(__('models/consultations.singular') . ' ' . __('messages.not_found'));

            return redirect(route('consultations.index'));
        }

        $consultation = $this->consultationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/consultations.singular')]));

        return redirect(route('consultations.index'));
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
