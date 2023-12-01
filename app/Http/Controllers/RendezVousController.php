<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRendezVousRequest;
use App\Http\Requests\UpdateRendezVousRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Consultation;
use App\Models\DossierPatientConsultation;
use App\Models\RendezVous;
use App\Models\DossierPatient;

use App\Repositories\RendezVousRepository;
use Illuminate\Http\Request;
use Flash;

class RendezVousController extends AppBaseController
{
    /** @var RendezVousRepository $rendezVousRepository*/
    private $rendezVousRepository;

    public function __construct(RendezVousRepository $rendezVousRepo)
    {
        $this->rendezVousRepository = $rendezVousRepo;
    }

    /**
     * Display a listing of the RendezVous.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $rendezVouses = $this->rendezVousRepository->paginate($query);

        foreach ($rendezVouses as $rendezVous) {
            $consultation_id = $rendezVous->consultation_id;
            $dossierConsultation = DossierPatientConsultation::where('consultation_id', $consultation_id)->first();
            
            if ($dossierConsultation) {
                $dossier_patient_id = $dossierConsultation->dossier_patient_id;
                $dossierPatient = DossierPatient::find($dossier_patient_id);
                if ($dossierPatient) {
                    $dossier_numero = $dossierPatient->numero_dossier;
                    $rendezVous->numero_dossier = $dossier_numero;
                }
            }
        }

        if ($request->ajax()) {
            return view('rendez_vouses.table')->with('rendezVouses', $rendezVouses);
        }

        return view('rendez_vouses.index')->with('rendezVouses', $rendezVouses);
    }

    /**
     * Show the form for creating a new RendezVous.
     */
    public function list_dossier()
    {
        $dossier_patients = DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
        ->join('consultations',  'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
        ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
        ->where("consultations.etat","enAttente")
        ->select('*')
        ->paginate();
        // dd($dossier_patients);
        return view('rendez_vouses.list_dossier_patient',compact("dossier_patients"));
    }

    public function create(Request $request)
    {
        $consultation_id = $request->consultation_id;
        return view('rendez_vouses.create',compact("consultation_id"));
    }

    /**
     * Store a newly created RendezVous in storage.
     */
    public function store(Request $request)
    {


         $RendezVous  =  new RendezVous;
         $RendezVous->date_rendez_vous =$request->date_rendez_vous;
         $RendezVous->consultation_id = $request->consultation_id;
         $RendezVous->remarques = $request->remarques;
         $RendezVous->etat = "Planifier";
         $RendezVous->save();

        $consultation = Consultation::find($request->consultation_id)->update(["etat"=>"enRendezVous"]);




        Flash::success(__('messages.saved', ['model' => __('models/rendezVouses.singular')]));

        return redirect(route('rendez-vous.index'));
    }

    /**
     * Display the specified RendezVous.
     */
    public function show($id)
    {
        $rendezVous = $this->rendezVousRepository->find($id);

        $consultation_id = $rendezVous->consultation_id;
        $dossierConsultation = DossierPatientConsultation::where('consultation_id', $consultation_id)->first();
            
        if ($dossierConsultation) {
            $dossier_patient_id = $dossierConsultation->dossier_patient_id;
            $dossierPatient = DossierPatient::find($dossier_patient_id);
            if ($dossierPatient) {
                $dossier_numero = $dossierPatient->numero_dossier;
                $rendezVous->numero_dossier = $dossier_numero;
            }
        }
        

        if (empty($rendezVous)) {
            Flash::error(__('models/rendezVouses.singular').' '.__('messages.not_found'));

            return redirect(route('rendez-vous.index'));
        }

        return view('rendez_vouses.show')->with('rendezVous', $rendezVous);
    }

    /**
     * Show the form for editing the specified RendezVous.
     */
    public function edit($id)
    {
        $rendezVous = $this->rendezVousRepository->find($id);

        if (empty($rendezVous)) {
            Flash::error(__('models/rendezVouses.singular').' '.__('messages.not_found'));

            return redirect(route('rendez-vouses.index'));
        }

        return view('rendez_vouses.edit')->with('rendezVous', $rendezVous);
    }

    /**
     * Update the specified RendezVous in storage.
     */
    public function update($id, UpdateRendezVousRequest $request)
    {
        $rendezVous = $this->rendezVousRepository->find($id);

        if (empty($rendezVous)) {
            Flash::error(__('models/rendezVouses.singular').' '.__('messages.not_found'));

            return redirect(route('rendez-vouses.index'));
        }

        $rendezVous = $this->rendezVousRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/rendezVouses.singular')]));

        return redirect(route('rendez-vouses.index'));
    }

    /**
     * Remove the specified RendezVous from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rendezVous = $this->rendezVousRepository->find($id);

        if (empty($rendezVous)) {
            Flash::error(__('models/rendezVouses.singular').' '.__('messages.not_found'));

            return redirect(route('rendez-vouses.index'));
        }

        $this->rendezVousRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/rendezVouses.singular')]));

        return redirect(route('rendez-vouses.index'));
    }
}
