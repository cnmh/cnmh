<?php

namespace App\Http\Controllers\PoleSocial;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EntretienSocial\DossierPatientRepository;
use App\Http\Requests\CreateDossierPatientRequest;
use App\Http\Requests\CreateTuteurRequest;
use App\Http\Requests\UpdateDossierPatientRequest;
use App\Repositories\EntretienSocial\TuteurRepository;
use App\Repositories\EntretienSocial\PatientRepository;
use App\Repositories\Parametres\EtatCivilRepository;







class EntretienSocialController extends AppBaseController
{
    private $dossierPatientRepository;

    public function __construct(DossierPatientRepository $dossierPatientRepo)
    {
        $this->dossierPatientRepository = $dossierPatientRepo;
    }


    /**
     * Phase 1 : Choix ou création du tuteur
    */
    public function FormSelectTuteur(){

        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);

            $tuteurs = Tuteur::join('etat_civils', 'tuteurs.etat_civil_id', '=', 'etat_civils.id')
            ->where('tuteurs.nom', 'like', '%' . $search . '%')
            ->orWhere('tuteurs.prenom', 'like', '%' . $search . '%')
            ->select('tuteurs.nom as tuteur_nom', 'etat_civils.id as etat_civil_id', 'tuteurs.prenom', 'tuteurs.adresse', 'tuteurs.telephone', 'tuteurs.email', 'etat_civils.nom as etat_civil_nom','tuteurs.id as id')
            ->paginate();

            return response()->json(['data' => $tuteurs]);
        }

        $query = $request->input('query');
        $tuteurRepository = new TuteurRepository;
        $tuteurs = $tuteurRepository->paginate($query);

        return view('dossier_patients.parent', compact("tuteurs"));

    }

    // pass tuteur a patient
    public function SelectTuteur($tuteurID){
        return redirect()->route('FormSelect.bénéficiaires', $tuteurID)->with('tuteur_id',$tuteurID);
    }

    public function FormAjouteTuteur(){
        $EtatCivil = new EtatCivilRepository;
        $etat_civil = $EtatCivil->all();
        return view('tuteurs.create', compact("etat_civil"));
    }

    // Ajouter le tuteur
    public function AjouteTuteur(CreateTuteurRequest $request){

        $input = $request->all();
        $tuteurExiste = $this->tuteurRepository->where(Tuteur::class,'cin',$input['cin'])->first();
        if($tuteurExiste){
            Flash::error('Tuteur est déja existe');
            return back();
        }

        $tuteur = $this->tuteurRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tuteurs.singular')]));
        $tuteurID = $tuteur->id;
        $this->FormSelectPatient($tuteurID);
    }



    /**
     * Phase 2  : Création ou choix de bénéficiaire 
    */
    public function FormSelectPatient($tuteurID){
        $patientRepository = new PatientRepository;
        $patients = $patientRepository->where(Patient::class,'tuteur_id',$tuteurID)->get();
        return view('dossier_patients.patient', compact("patients"));
    }

    // pass Patient a entretien
    public function SelectPatient($PatientID){
        return redirect()->route('FormEntretienSocial', $PatientID)->with('patient_id',$PatientID);
    }

    public function FormAjoutePatient(){
        $tuteur = Tuteur::all();
        $niveau_s = NiveauScolaire::all();
        return view('patients.create',compact("tuteur","niveau_s"));
    }

    // Ajouter le Patient
    public function AjoutePatient(CreateTuteurRequest $request){

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
        $patient = $patientRepository->create($input);
        Flash::success(__('messages.saved', ['model' => __('models/patients.singular')]));
        $PatientID = $patient->id;
        $this->FormEntretienSocial($PatientID);
    }


    // Phase 3 : Ajouter enquette social
    public function FormEntretienSocial($PatientID){
        $editMode = false; 
        $couverture_medical = CouvertureMedical::all();
        $type_handicap = TypeHandicap::all();
        $services = Service::all();
        $PatientID = $PatientID;
        return view('dossier_patients.entretien', compact('type_handicap', 'couverture_medical','services','editMode','PatientID'));
    }

    public function AjouterEntretienSocial(CreateDossierPatientRequest $request,$PatientID){
        $enquette = $request->all();
        $dossierPatientExiste = DossierPatient::where('patient_id',$PatientID)->first();
        // Règle : 
        if($dossierPatientExiste){
            Flash::error("Dossier patient est déja existé");
            return back();
        }
        // Traitement 
        // $latestDossier = DossierPatient::where('numero_dossier', 'like', 'A-%')
        //     ->whereRaw('CAST(SUBSTRING(numero_dossier, 3) AS SIGNED) IS NOT NULL')
        //     ->max('numero_dossier');
        // $counter = $latestDossier ? (int)substr($latestDossier, 2) + 1 : 1802;
        // $numeroDossier = 'A-' . $counter;
        // $input['numero_dossier'] = $numeroDossier;
        $dossierPatient = $this->dossierPatientRepository->entretienSocial($enquette,$PatientID);
        // Sortie
        Flash::success(__('messages.saved', ['model' => __('models/dossierPatients.singular')]));
        return redirect(route('dossier-patients.index'));
    }

   
}
