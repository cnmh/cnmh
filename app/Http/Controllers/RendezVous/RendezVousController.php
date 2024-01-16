<?php

namespace App\Http\Controllers\RendezVous;

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
use Illuminate\Support\Facades\Auth;

class RendezVousController extends AppBaseController
{
    /** @var RendezVousRepository $rendezVousRepository*/
    private $rendezVousRepository;

    public function __construct(RendezVousRepository $rendezVousRepo)
    {
        $this->rendezVousRepository = $rendezVousRepo;
    }


    public function list_rendezVous(Request $request)
    {
       
    }

    /**
     * Phase 1 : list des dossier
     */

    public function list_dossier(){
        $dossierPatientRepo = new DossierPatientRepository;
        $dossier_patients = $dossierPatientRepo->listDossier();
        return view('rendez_vouses.list_dossier_patient',compact("dossier_patients"));
    }


    public function FormAjouterRendezVous(Request $request){
        $consultation_id = $request->consultation_id;
        if(empty($consultation_id)){
            return back();
        }
        return view('rendez_vouses.create',compact("consultation_id"));
    }

    public function AjouterRendezVous(Request $request){
        $this->validate($request, [
            'date_rendez_vous' => 'required|date',
            'consultation_id' => 'required|exists:consultations,id',
            'remarques' => 'nullable|string',
        ]);
        $rendezVousRepository->create($request->all());
        Flash::success(__('messages.saved', ['model' => __('models/rendezVouses.singular')]));
        return redirect(route('rendez-vous.index'));
    }


}
