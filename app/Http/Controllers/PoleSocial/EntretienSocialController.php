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
use App\Models\User;
use App\Models\TypeHandicap;
use App\Models\EtatCivil;
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
            $dossierPatients = $this->dossierPatientRepository->search($search);
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
            if($search != ""){
                $search = str_replace(" ", "%", $search);
                $tuteurRepository = new TuteurRepository;
                $tuteurs = $tuteurRepository->search($search);
                return response()->json(['data' => $tuteurs]);
            }
            
        }
        $query = $request->input('query');
        $tuteurRepository = new TuteurRepository;
        $tuteurs = $tuteurRepository->paginate($query);
        return view('PoleSocial.dossier_patients.parent', compact("tuteurs"));
    }

    // pass tuteur a patient
    public function SelectTuteur(Request $request){
        if(empty($request->tuteurID)){
            return redirect()->route('FormSelect.bénéficiaires','self')->with('tuteur_id','self');
        }
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
        if(empty($request->patientRadio)){
            return back();
        }
        return redirect()->route('FormEntretienSocial', $request->patientRadio)->with('patient_id',$request->patientRadio);
    }

    public function FormAjoutePatient($tuteurID){
        if($tuteurID !== 'self'){
            $tuteurs = new TuteurRepository;
            $tuteur = $tuteurs->find($tuteurID);
        }else{
            $tuteur = "";
        }       
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

        $latestDossier = $this->dossierPatientRepository->NumeroDossier();
        $counter = $latestDossier ? (int)substr($latestDossier, 2) + 1 : 1;
        $numeroDossier = 'A-' . $counter;
        $PatientID = $PatientID;
        return view('PoleSocial.dossier_patients.entretien', compact('type_handicap', 'couverture_medical','services','editMode','PatientID','numeroDossier'));
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
        $dossierPatient = $this->dossierPatientRepository->entretienSocial($enquette,$PatientID);
        // Sortie
        Flash::success(__('messages.saved', ['model' => __('models/dossierPatients.singular')]));
        return redirect(route('dossier-patients.list'));
    }



    public function show_dossier($id){

        $dossierPatient = $this->dossierPatientRepository->where(DossierPatient::class,'numero_dossier',$id)->first();
        $user = User::where('id',$dossierPatient->user_id)->first();
        $responsableEntrotient = $user->name;
        $patientRepository = new PatientRepository;
        $patient = $patientRepository->find($dossierPatient->patient_id);
        $NiveauScolaireID = $patient->niveau_scolaire_id;
        $niveauScolaireRepo = new NiveauScolaireRepository;
        $NiveauScolairePatient = $niveauScolaireRepo->find($NiveauScolaireID);
        $parent  = $patient->parent;
        $EtatCivilRepo = new EtatCivilRepository;
        if(!empty($parent)){
            $situationFamilial =$EtatCivilRepo->where(EtatCivil::class,'id',$parent->etat_civil_id)->first();
        }else{
            $situationFamilial = "";
        }
        $couvertureMedicalRepo = new CouvertureMedicalRepository;
        $couvertureMedical = $couvertureMedicalRepo->find($dossierPatient->couverture_medical_id);
        $type_handicap = $this->dossierPatientRepository->DossierPatient_typeHandycapFIND($dossierPatient->id);
        $service_demander = $this->dossierPatientRepository->DossierPatient_serviceFIND($dossierPatient->id);
        foreach($type_handicap as $type_handicap_id){
            $typeHandicapRepo = new TypeHandicapRepository;
            $type_handicap = $typeHandicapRepo->find($type_handicap_id->type_handicap_id);
            $type_handicap_patient[] = $type_handicap;
        }
        foreach($service_demander as $item){
            $serviceRepo = new ServiceRepository;
            $service = $serviceRepo->find($item->service_id);
            $service_demander_patient[] = $service;
        }
        $consultation = $dossierPatient->dossierPatientConsultations;
        $dossierPatientConsultation = $this->dossierPatientRepository->DossierPatient_consultationFIND($dossierPatient->id);
        $consultationID = $dossierPatientConsultation->consultation_id;

        $listAttent = $this->dossierPatientRepository->ListAttenteFIND($consultationID);
        $médecin = $this->dossierPatientRepository->ConsultationNedecinFIND($dossierPatientConsultation->consultation_id);
        $service = $dossierPatient->dossierPatientServices;
        $title = 'MedecinGeneral';
        $listrendezvous = $this->dossierPatientRepository->rendezVousPatient();
        if (empty($dossierPatient)) {
            Flash::error(__('models/dossierPatients.singular') . ' ' . __('messages.not_found'));
            return redirect(route('dossier-patients.list'));
        }
        return view('PoleSocial.dossier_patients.show',compact('dossierPatient',"patient","parent","listrendezvous","responsableEntrotient","couvertureMedical","situationFamilial","type_handicap_patient","NiveauScolairePatient","listAttent","médecin","service_demander_patient","title"));
    }


    public function edit($id){

        $dossierPatient = $this->dossierPatientRepository->where(DossierPatient::class,'numero_dossier',$id)->first();
        if (empty($dossierPatient)) {
            Flash::error(__('models/dossierPatients.singular') . ' ' . __('messages.not_found'));
            return redirect(route('dossier-patients.index'));
        }
        $patient_id = $dossierPatient->patient_id;
        $editMode = true; 
        $patientRepository = new PatientRepository;
        $beneficiaires_tuteur = $patientRepository->where(Patient::class,'id', $patient_id)->first();
        if($beneficiaires_tuteur->tuteur_id === null){
            $patients_tuteur = $patientRepository->find($beneficiaires_tuteur->id);
        }else{
            $patients_tuteur = $patientRepository->where(Patient::class,'tuteur_id',$beneficiaires_tuteur->tuteur_id)->get();
        }
        $tuteurRepo = new TuteurRepository;
        $tuteur = $tuteurRepo->where(Tuteur::class,'id', $beneficiaires_tuteur->tuteur_id)->first();
        $typeHandicap = new TypeHandicapRepository;
        $type_handicap = $typeHandicap->paginate();
        $service = new ServiceRepository;
        $services = $service->paginate();
        $couvertureMedical = new CouvertureMedicalRepository;
        $couverture_medical = $couvertureMedical->paginate();
        $dossierPatientID = $dossierPatient->id; 
        $DossierPatient_typeHandycap = $this->dossierPatientRepository->DossierPatient_typeHandycapFIND($dossierPatient->id);
        $service_dossier_patient = $this->dossierPatientRepository->DossierPatient_serviceFIND($dossierPatient->id);
        $service_patient = $service_dossier_patient->pluck('service_id')->toArray();
        $typeHandicapIDs = $DossierPatient_typeHandycap->pluck('type_handicap_id')->toArray();
        $type_handicap_patient = $typeHandicap->where(TypeHandicap::class,'id', $typeHandicapIDs)->get();
        $patientId = $dossierPatient->patient_id;
        $numeroDossier = $dossierPatient->numero_dossier;
        return view('PoleSocial.dossier_patients.edit',compact('dossierPatient','type_handicap','couverture_medical','patientId','type_handicap_patient','service_patient','services','patients_tuteur','tuteur','editMode','numeroDossier'));
    }

   
    public function update($id, UpdateDossierPatientRequest $request)
    {
        $input = $request->all();
        $dossierPatient = $this->dossierPatientRepository->where(DossierPatient::class,'numero_dossier',$id)->first();
        $dossierPatientID = $dossierPatient->id;
        if (empty($dossierPatient)) {
            Flash::error(__('models/dossierPatients.singular') . ' ' . __('messages.not_found'));
            return redirect(route('dossier-patients.index'));
        }
        $typeHandicapIDs = $input['type_handicap_id'];
        $service_ids = $input['services_id'];
        $typeHandycapDossierPatientIfExiste = $this->dossierPatientRepository->typeHandycapDossierPatientIfExisteDelete($dossierPatientID,$typeHandicapIDs);
        foreach ($typeHandicapIDs as $typeHandicapID) {
            $this->dossierPatientRepository->typeHandycapDossierPatientUpdate($dossierPatientID,$typeHandicapID);
        }
        $serviceDossierPatientIfExiste = $this->dossierPatientRepository->serviceDossierPatientIfExisteDelete($dossierPatientID,$service_ids);
        foreach($service_ids as $service_id){
            $this->dossierPatientRepository->serviceDossierPatientUpdate($dossierPatientID,$service_id);
        }

        $dossierPatient = $this->dossierPatientRepository->update($input, $dossierPatientID);
        Flash::success(__('messages.updated', ['model' => __('models/dossierPatients.singular')]));
        return redirect(route('dossier-patients.list'));
    }

    public function destroy($id)
    {
        $dossierPatient = $this->dossierPatientRepository->where(DossierPatient::class,'numero_dossier',$id)->first();

        $dossierPatientID = $dossierPatient->id;

        if ($dossierPatient) {
            $OrientationExterne = $this->dossierPatientRepository->OrientationExterneFIND($dossierPatientID);
            $dossierPatientConsultation = $this->dossierPatientRepository->DossierPatient_consultationFIND($dossierPatientID);
            $DossierPatient_typeHandycape = $this->dossierPatientRepository->DossierPatient_typeHandycapFIND($dossierPatientID);

            if ($OrientationExterne) {
                Flash::error(__('messages.cannotDeleted', ['model' => __('models/dossierPatients.OrientationExterne')]));
            } else {

                    $consultation = $dossierPatientConsultation->consultation_id;
                    $consultations = $this->dossierPatientRepository->ConsultationFIND($consultation);
                    $consultationEtat = $consultations->etat;
                    if($consultationEtat === 'enRendezVous' || $consultationEtat === 'enConsultation'){
                        Flash::error(__('messages.cannotDeletedEnCounsultation', ['model' => __('models/dossierPatients.enconsultation')]));
                        return back();
                    }
                    else {
                        $this->dossierPatientRepository->deleteDossierPatientConsultation($dossierPatientID);
                        $this->dossierPatientRepository->deleteDossierPatient_typeHandycape($dossierPatientID);
                        $this->dossierPatientRepository->deleteDossierPatient_service($dossierPatientID); 
                    } 

                    $this->dossierPatientRepository->delete($dossierPatientID);
                    Flash::success(__('messages.deleted', ['model' => __('models/dossierPatients.singular')]));
            }
        }
        
        if (empty($dossierPatient)) {
            Flash::error(__('models/dossierPatients.singular') . ' ' . __('messages.not_found'));
            return back();
        }

        return redirect(route('dossier-patients.list'));
    }


   
}
