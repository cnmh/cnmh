<?php

namespace App\Http\Controllers\PoleSocial;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EntretienSocial\DossierPatientRepository;
use App\Http\Requests\CreateDossierPatientRequest;
use App\Http\Requests\CreateTuteurRequest;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdateDossierPatientRequest;
use App\Repositories\EntretienSocial\TuteurRepository;
use App\Repositories\EntretienSocial\PatientRepository;
use App\Repositories\Parametres\EtatCivilRepository;
use App\Repositories\Parametres\NiveauScolaireRepository;
use App\Repositories\Parametres\CouvertureMedicalRepository;
use App\Repositories\Parametres\TypeHandicapRepository;
use App\Repositories\Parametres\ServiceRepository;
use App\Models\Patient;
use App\Models\Tuteur;
use App\Models\DossierPatient;
use Flash;




class EntretienSocialController extends AppBaseController
{
    private $dossierPatientRepository;

    public function __construct(DossierPatientRepository $dossierPatientRepo)
    {
        $this->dossierPatientRepository = $dossierPatientRepo;
    }


    public function list_dossier(Request $request){
        $dossierPatients = $this->dossierPatientRepository->paginate();


        if ($request->ajax()) {
            $search = $request->get('search');
            $search = str_replace(" ", "%", $search);
        
            $dossierPatients = DossierPatient::join('patients', function ($join) {
                $join->on('dossier_patients.patient_id', '=', 'patients.id')
                    ->select('patients.id as patientID', 'patients.*', 'dossier_patients.numero_dossier as dossier_id');
            })
            ->where('patients.nom', 'like', '%' . $search . '%')
            ->orWhere('dossier_patients.numero_dossier', 'like', '%' . $search . '%')->orderBy('dossier_patients.numero_dossier')
            ->paginate();
        

        
            return view('PoleSocial.dossier_patients.table')
                ->with('dossierPatients', $dossierPatients)
                ->render();
        }

        return view('PoleSocial.dossier_patients.index')
            ->with('dossierPatients', $dossierPatients);
    }


    /**
     * Phase 1 : Choix ou création du tuteur
    */
    public function FormSelectTuteur(Request $request){

        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
            $tuteurRepository = new TuteurRepository;
            $tuteurs = $tuteurRepository->search($search);
            return response()->json(['data' => $tuteurs]);
        }
        $query = $request->input('query');
        $tuteurRepository = new TuteurRepository;
        $tuteurs = $tuteurRepository->paginate($query);
        return view('PoleSocial.dossier_patients.parent', compact("tuteurs"));
    }

    // pass tuteur a patient
    public function SelectTuteur(Request $request){
        return redirect()->route('FormSelect.bénéficiaires', $request->tuteurID)->with('tuteur_id',$request->tuteurID);
    }

    public function FormAjouteTuteur(){
        $EtatCivil = new EtatCivilRepository;
        $etat_civil = $EtatCivil->all();
        return view('PoleSocial.tuteurs.create', compact("etat_civil"));
    }

    // Ajouter le tuteur
    public function AjouteTuteur(CreateTuteurRequest $request){
        $input = $request->all();
        $tuteurRepository = new TuteurRepository;
        $tuteurExiste = $tuteurRepository->where(Tuteur::class,'cin',$input['cin'])->first();
        if($tuteurExiste){
            Flash::error('Tuteur est déja existe');
            return back();
        }
        $tuteur = $tuteurRepository->create($input);
        Flash::success(__('messages.saved', ['model' => __('models/tuteurs.singular')]));
        $tuteurID = $tuteur->id;
        return redirect()->route('FormSelect.bénéficiaires',$tuteurID);
    }



    /**
     * Phase 2  : Création ou choix de bénéficiaire 
    */
    public function FormSelectPatient($tuteurID){
        $patientRepository = new PatientRepository;
        $tuteur_id = $tuteurID;
        $patients = $patientRepository->where(Patient::class,'tuteur_id',$tuteurID)->get();
        return view('PoleSocial.dossier_patients.patient', compact("patients",'tuteur_id'));
    }

    // pass Patient a entretien
    public function SelectPatient(Request $request){
        return redirect()->route('FormEntretienSocial', $request->patientRadio)->with('patient_id',$request->patientRadio);
    }

    public function FormAjoutePatient($tuteurID){
        $tuteurs = new TuteurRepository;
        $tuteur = $tuteurs->find($tuteurID);
        $niveauScolaire = new NiveauScolaireRepository;
        $niveau_s = $niveauScolaire->get();
        return view('PoleSocial.patients.create',compact("tuteur","niveau_s"));
    }

    // Ajouter le Patient
    public function AjoutePatient(CreatePatientRequest $request){

        $input = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('assets/images/' . $filename);
            $image->move(public_path('assets/images'), $filename);
            $input['image'] = 'assets/images/' . $filename;
        }
        $patientRepository = new PatientRepository;
        $nom = $input['nom'];
        $prenom = $input['prenom'];

        $patientExiste = $patientRepository->PatientExiste($nom,$prenom);
        if($patientExiste){
            Flash::error("Patient déja existé");
            return back();
        }
        $patient = $patientRepository->create($input);
        Flash::success(__('messages.saved', ['model' => __('models/patients.singular')]));
        $PatientID = $patient->id;
        return redirect()->route('FormEntretienSocial',$PatientID);
    }


    // Phase 3 : Ajouter enquette social
    public function FormEntretienSocial($PatientID){
        $editMode = false; 
        $couvertureMedical = new CouvertureMedicalRepository;
        $couverture_medical = $couvertureMedical->all();
        $typeHandicap = new TypeHandicapRepository;
        $type_handicap = $typeHandicap->all();
        $service = new ServiceRepository;
        $services = $service->all();
        $PatientID = $PatientID;
        return view('PoleSocial.dossier_patients.entretien', compact('type_handicap', 'couverture_medical','services','editMode','PatientID'));
    }

    public function AjouterEntretienSocial(CreateDossierPatientRequest $request,$PatientID){
        $enquette = $request->all();
        $dossierPatientExiste = $this->dossierPatientRepository->DossierExiste($PatientID);
        // Règle : 
        if($dossierPatientExiste){
            Flash::error("Dossier patient est déja existé");
            return back();
        }
        // Traitement 
        $latestDossier = $this->dossierPatientRepository->NumeroDossier();
        $counter = $latestDossier ? (int)substr($latestDossier, 2) + 1 : 1802;
        $numeroDossier = 'A-' . $counter;
        $enquette['numero_dossier'] = $numeroDossier;
        $dossierPatient = $this->dossierPatientRepository->entretienSocial($enquette,$PatientID);
        // Sortie
        Flash::success(__('messages.saved', ['model' => __('models/dossierPatients.singular')]));
        return redirect(route('dossier-patients.index'));
    }

   
}
