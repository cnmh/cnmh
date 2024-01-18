<?php

namespace App\Http\Controllers\PoleSocial;

use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\NiveauScolaire;
use App\Models\Tuteur;
use App\Models\Patient;
use App\Models\DossierPatient;
use App\Repositories\Parametres\NiveauScolaireRepository;
use App\Repositories\EntretienSocial\TuteurRepository;
use App\Repositories\EntretienSocial\PatientRepository;
use App\Repositories\EntretienSocial\DossierPatientRepository;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Flash;

class PatientController extends AppBaseController
{
    /** @var PatientRepository $patientRepository*/
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Patient.
     */
    public function index(Request $request)
    {

        $query = $request->input('query');
        $patients = $this->patientRepository->paginate($query);

        if ($request->ajax()) {
            return view('patients.table')
                ->with('patients', $patients);
        }

        return view('patients.index')
            ->with('patients', $patients);
    }

    /**
     * Show the form for creating a new Patient.
     */
    public function create()
    {
        $tuteurs = new TuteurRepository;
        $tuteur = $tuteurs->get();
        $niveauScolaire = new NiveauScolaireRepository;
        $niveau_s = $niveauScolaire->get();
        return view('patients.create',compact("tuteur","niveau_s"));
    }

    /**
     * Store a newly created Patient in storage.
     */
    public function store(CreatePatientRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('assets/images/' . $filename);
            $image->move(public_path('assets/images'), $filename);
            $input['image'] = 'assets/images/' . $filename;

        }
        $patientRepository = new PatientRepository;
        $patientExiste = $patientRepository->where(Patient::class,'nom',$input['nom'])->first();
        if($patientExiste){
            Flash::error("Patient déja existé");
            return back();
        }

        $patient = $this->patientRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/patients.singular')]));

        if($request->parentRadio){

        return redirect("/entretien/$request->parentRadio?patientRadio=$patient->id");
    }
    return redirect(route('patients.index'));

    }

    /**
     * Display the specified Patient.
     */
    public function show($id)
    {
        $patient = $this->patientRepository->find($id);
        if (empty($patient)) {
            Flash::error(__('models/patients.singular').' '.__('messages.not_found'));

            return redirect(route('patients.index'));
        }
        return view('patients.show')->with('patient', $patient);
    }

    /**
     * Show the form for editing the specified Patient.
     */
    public function edit($id , Request $request)
    {
        $patient = $this->patientRepository->find($id);
        $previousUrl = $request->input('previous_url', route('dossier-patients.index'));
        $tuteurs = new TuteurRepository;
        $tuteur = $tuteurs->find($patient->tuteur_id);
        $niveauScolaire = new NiveauScolaireRepository;
        $niveauScolaire = $niveauScolaire->find($patient->niveau_scolaire_id);
        if (empty($patient)) {
            Flash::error(__('models/patients.singular').' '.__('messages.not_found'));

            return redirect(route('patients.index'));
        }
        return view('patients.edit')->with(['patient' => $patient, 'tuteur' => $tuteur , 'niveau_s' => $niveauScolaire , 'previousUrl' => $previousUrl]);
    }


    

    /**
     * Update the specified Patient in storage.
     */
    public function update($id, UpdatePatientRequest $request)
    {
        $patient = $this->patientRepository->find($id);

        if (empty($patient)) {
            Flash::error(__('models/patients.singular').' '.__('messages.not_found'));

            return redirect(route('patients.index'));
        }

        $previousUrl = $request->input('previous_url');
        $patient = $this->patientRepository->update($request->all(), $id);

        $dossierPatientRepo = new DossierPatientRepository;
        $dossier_patient = $dossierPatientRepo->where(DossierPatient::class,'patient_id',$patient->id)->first();
        $numeroDossier = $dossier_patient->numero_dossier;
        Flash::success(__('messages.updated', ['model' => __('models/patients.singular')]));
        if (strpos($previousUrl, 'entretien-social') !== false) {
            $redirectUrl = $previousUrl . '/'. $numeroDossier .'/edit';
            return redirect($redirectUrl);
        }
        return redirect(route('patients.index'));
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $patient = $this->patientRepository->find($id);
        if (empty($patient)) {
            Flash::error(__('models/patients.singular').' '.__('messages.not_found'));

            return redirect(route('patients.index'));
        }
        if($patient){
            $reclamation = Reclamation::where('patient_id',$patient->id)->first();
            $reclamation->delete();
        }
        $this->patientRepository->delete($id);
        Flash::success(__('messages.deleted', ['model' => __('models/patients.singular')]));
        return redirect(route('patients.index'));
    }
}
