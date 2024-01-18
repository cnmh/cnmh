<?php

namespace App\Http\Controllers\PoleSocial;

use App\Http\Requests\CreateTuteurRequest;
use App\Http\Requests\UpdateTuteurRequest;
use App\Http\Controllers\AppBaseController;

use App\Models\Patient;
use App\Repositories\EntretienSocial\TuteurRepository;
use App\Repositories\EntretienSocial\PatientRepository;

use App\Repositories\Parametres\EtatCivilRepository;
use App\Repositories\Parametres\NiveauScolaireRepository;
use App\Repositories\Parametres\CouvertureMedicalRepository;
use App\Repositories\Parametres\TypeHandicapRepository;
use App\Repositories\Parametres\ServiceRepository;
use App\Repositories\EntretienSocial\DossierPatientRepository;


use App\Models\DossierPatient;
use Illuminate\Http\Request;
use Flash;

/**
 * @author codeCampers, Boukhar Soufiane
 */

class TuteurController extends AppBaseController
{
    /** @var TuteurRepository $tuteurRepository*/
    private $tuteurRepository;

    public function __construct(TuteurRepository $tuteurRepo)
    {
        $this->tuteurRepository = $tuteurRepo;
    }

    /**
     * Display a listing of the Tuteur.
     */
    public function index(Request $request)
    {

        $query = $request->input('query');
        $tuteurs = $this->tuteurRepository->paginate($query);
        if ($request->ajax()) {
            return view('tuteurs.table')
                ->with('tuteurs', $tuteurs);
        }

        return view('tuteurs.index')
            ->with('tuteurs', $tuteurs);
    }

    /**
     * Show the form for creating a new Tuteur.
     */
    public function create()
    {
        $etat_civil = EtatCivil::get();
        return view('tuteurs.create', compact("etat_civil"));
    }

    /**
     * Store a newly created Tuteur in storage.
     */
    public function store(CreateTuteurRequest $request)
    {
        $input = $request->all();
        $tuteurExiste = $this->tuteurRepository->where(Tuteur::class,'cin',$input['cin'])->first();
        if($tuteurExiste){
            Flash::error('Tuteur est déja existe');
            return back();
        }
        $tuteur = $this->tuteurRepository->create($input);
        Flash::success(__('messages.saved', ['model' => __('models/tuteurs.singular')]));
        if ($request->parentForm) {
            return redirect("/patientForm?parentRadio=$tuteur->id");
        } else {
            return redirect(route('tuteurs.index'));
        }
    }

    /**
     * Display the specified Tuteur.
     */
    public function show($id)
    {
        $tuteur = $this->tuteurRepository->find($id);
        if (empty($tuteur)) {
            Flash::error(__('models/tuteurs.singular') . ' ' . __('messages.not_found'));

            return redirect(route('tuteurs.index'));
        }
        return view('tuteurs.show')->with('tuteur', $tuteur);
    }

    /**
     * Show the form for editing the specified Tuteur.
     */
    public function edit($id , Request $request)
    {
        $tuteur = $this->tuteurRepository->find($id);
        $previousUrl = $request->input('previous_url', route('dossier-patients.index')); 
        if (empty($tuteur)) {
            Flash::error(__('models/tuteurs.singular') . ' ' . __('messages.not_found'));
            return redirect(route('tuteurs.index'));
        }
        $EtatCivil = new EtatCivilRepository;
        $etat_civil = $EtatCivil->find($tuteur->etat_civil_id);
        return view('tuteurs.edit', compact('tuteur', 'etat_civil','previousUrl'));
    }
    
    /**
     * Update the specified Tuteur in storage.
     */
    public function update($id, UpdateTuteurRequest $request)
    {
        $tuteur = $this->tuteurRepository->find($id);
        if (empty($tuteur)) {
            Flash::error(__('models/tuteurs.singular') . ' ' . __('messages.not_found'));

            return redirect(route('tuteurs.index'));
        }
        $previousUrl = $request->input('previous_url');
        $tuteur = $this->tuteurRepository->update($request->all(), $id);
        $patientRepo = new PatientRepository;
        $patient = $patientRepo->where(Patient::class,'tuteur_id',$id)->first();
        $dossierPatientRepo = new DossierPatientRepository;
        $dossier_patient = $dossierPatientRepo->where(DossierPatient::class,'patient_id',$patient->id)->first();
        $numeroDossier = $dossier_patient->numero_dossier;
        Flash::success(__('messages.updated', ['model' => __('models/tuteurs.singular')]));

        if (strpos($previousUrl, 'entretien-social') !== false) {
            $redirectUrl = $previousUrl . '/'. $numeroDossier .'/edit';
            return redirect($redirectUrl);
        }

        return redirect(route('tuteurs.index'));
    }

    /**
     * Remove the specified Tuteur from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tuteur = $this->tuteurRepository->find($id);
        if (empty($tuteur)) {
            Flash::error(__('models/tuteurs.singular') . ' ' . __('messages.not_found'));

            return redirect(route('tuteurs.index'));
        }
        if($tuteur){

            $patientRepo = new PatientRepository;
            $patient = $patientRepo->where(Patient::class,'tuteur_id',$id)->first();

            if($patient){
                Flash::error(__("Le tuteur a des patients associés. Supprimez d'abord le patient"));
                return redirect(route('tuteurs.index'));
            }
            
        }
        $this->tuteurRepository->delete($id);
        Flash::success(__('messages.deleted', ['model' => __('models/tuteurs.singular')]));
        return redirect(route('tuteurs.index'));
    }
}
