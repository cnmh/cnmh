<?php

namespace App\Http\Controllers;

use Flash;
use App\Models\Patient;
use App\Models\Service;
use App\Models\RendezVous;
use App\Models\Consultation;
use App\Models\TypeHandicap;
use Illuminate\Http\Request;
use App\Models\DossierPatient;
use App\Models\CouvertureMedical;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportDossierPatient;
use App\Repositories\TuteurRepository;
use App\Repositories\PatientRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\DossierPatient_typeHandycape;
use App\Repositories\DossierPatientRepository;
use App\Http\Requests\CreateDossierPatientRequest;
use App\Http\Requests\UpdateDossierPatientRequest;
use App\Models\DossierPatientConsultation;
use App\Models\OrientationExterne;
use App\Imports\ImportDossierPatientGlobal;











/**
 * @author CodeCampers, Boukhar Soufiane
 */
class DossierPatientController extends AppBaseController
{
    /** @var DossierPatientRepository $dossierPatientRepository*/
    private $dossierPatientRepository;

    public function __construct(DossierPatientRepository $dossierPatientRepo)
    {
        $this->dossierPatientRepository = $dossierPatientRepo;



    }

    /**
     * Display a listing of the DossierPatient.
     */
    public function index(Request $request)
    {

        $dossierPatients = $this->dossierPatientRepository->paginate();

        if ($request->ajax()) {
            $search = $request->get('search');
            $search = str_replace(" ", "%", $search);
        
            $dossierPatients = DossierPatient::join('patients', function ($join) {
                $join->on('dossier_patients.patient_id', '=', 'patients.id')
                    ->select('patients.id as patientID', 'patients.*', 'dossier_patients.numero_dossier as dossier_id');
            })
            ->where('patients.nom', 'like', '%' . $search . '%')
            ->orWhere('dossier_patients.numero_dossier', 'like', '%' . $search . '%')
            ->paginate();
        

        
            return view('dossier_patients.table')
                ->with('dossierPatients', $dossierPatients)
                ->render();
        }

        return view('dossier_patients.index')
            ->with('dossierPatients', $dossierPatients);
    }

    /**
     * Show the form for creating a new DossierPatient.
     */
    public function create()
    {
        return view('dossier_patients.create');
    }

    /**
     * Store a newly created DossierPatient in storage.
    */
    public function store(CreateDossierPatientRequest $request)
    {
        $input = $request->all();

        $latestDossier = DossierPatient::where('numero_dossier', 'like', 'A-%')
            ->whereRaw('CAST(SUBSTRING(numero_dossier, 3) AS SIGNED) IS NOT NULL')
            ->max('numero_dossier');
    
        $counter = $latestDossier ? (int)substr($latestDossier, 2) + 1 : 1802;
    
        $numeroDossier = 'A-' . $counter;
    
        $input['numero_dossier'] = $numeroDossier;
    
        $dossierPatient = $this->dossierPatientRepository->create($input);
        $dossierPatient->save();
        
        $dossierPatient = DossierPatient::where('numero_dossier', $numeroDossier)->first();
        $DossierPatient_typeHandycape = new DossierPatient_typeHandycape;

        $typeHandycapeIDs = $request->input('type_handicap_id');
        
        foreach ($typeHandycapeIDs as $typeHandycapeID) {
            $DossierPatient_typeHandycape = new DossierPatient_typeHandycape;
            $DossierPatient_typeHandycape->type_handicap_id = $typeHandycapeID;
            $DossierPatient_typeHandycape->dossier_patient_id = $dossierPatient->id;
            $DossierPatient_typeHandycape->save();
        }
        
        $consultation = new Consultation();
        $consultation->date_enregistrement=$request->date_enregsitrement;
        $consultation->type="medecinGeneral";
        $consultation->etat="enAttente";
        $consultation->save();

         $DossierPatient_consultation =  new DossierPatientConsultation;

        $DossierPatient_consultation->dossier_patient_id = $dossierPatient->id;
        $DossierPatient_consultation->consultation_id  = $consultation->id;
        $DossierPatient_consultation->save();



        Flash::success(__('messages.saved', ['model' => __('models/dossierPatients.singular')]));

        return redirect(route('dossier-patients.index'));
    }

    /**
     * Display the specified DossierPatient.
     */
    public function show($id)
    {


        $dossierPatient = $this->dossierPatientRepository->where(DossierPatient::class,'numero_dossier',$id)->first();
        $patient = Patient::find($dossierPatient->patient_id);
        $parent  = $patient->parent;
        // $consultation=Consultation::find($dossierPatient->patient_id);
        // $pp=$consultation->id;
        // $rendevous=RendezVous::find($pp);
        // dd($consultation);
        // $consultation=Consultation::find($id);
        $consultation = $dossierPatient->dossierPatientConsultations;
        $service = $dossierPatient->dossierPatientServices;
        foreach ($consultation as $value) {
            $R = RendezVous::where('consultation_id', $value->id)->get();
        }
        // foreach($service as $value){
        //

        $listrendezvous=DossierPatient::join('dossier_patient_consultation', 'dossier_patients.patient_id', '=', 'dossier_patient_consultation.dossier_patient_id')
        ->join('consultations','consultations.id','=','dossier_patient_consultation.consultation_id')
        ->join('rendez_vous','rendez_vous.consultation_id','=','dossier_patient_consultation.consultation_id')
        ->join('consultation_services','consultation_services.consultation_id','=','dossier_patient_consultation.consultation_id')
        ->join('services','services.id','=','consultation_services.service_id')
        ->where('dossier_patients.patient_id',$dossierPatient->patient_id)
        ->select(['rendez_vous.date_rendez_vous','rendez_vous.etat', 'services.nom','dossier_patients.patient_id'])
        ->groupBy('rendez_vous.date_rendez_vous', 'rendez_vous.etat','services.nom','dossier_patients.patient_id')
        ->get();
        // dd($listrendezvous);
        // $consultation=$dossierPatient->dossierPatientConsultations;
        // $service=$dossierPatient->dossierPatientServices;
        // $serviceconsultation=$service->;
        // foreach($consultation as $value){
        //     $R=RendezVous::where('consultation_id',$value->id)->get();
        // }

        if (empty($dossierPatient)) {
            Flash::error(__('models/dossierPatients.singular') . ' ' . __('messages.not_found'));

            return redirect(route('dossier-patients.index'));
        }

        return view('dossier_patients.show',compact('dossierPatient',"patient","parent","listrendezvous"));
    }

    /**
     * Show the form for editing the specified DossierPatient.
     */
    public function edit($id)
    {

        $dossierPatient = $this->dossierPatientRepository->where(DossierPatient::class,'numero_dossier',$id)->first();

        if (empty($dossierPatient)) {
            Flash::error(__('models/dossierPatients.singular') . ' ' . __('messages.not_found'));

            return redirect(route('dossier-patients.index'));
        }

        $type_handicap = TypeHandicap::all();
        $couverture_medical = CouvertureMedical::all();
        $dossierPatientID = $dossierPatient->id; 

        $DossierPatient_typeHandycap = DossierPatient_typeHandycape::where('dossier_patient_id', $dossierPatientID)->get();

        $typeHandicapIDs = $DossierPatient_typeHandycap->pluck('type_handicap_id')->toArray();

        $type_handicap_patient = TypeHandicap::whereIn('id', $typeHandicapIDs)->get();

        $patientId = $dossierPatient->patient_id;

        return view('dossier_patients.edit',compact('dossierPatient','type_handicap','couverture_medical','patientId','type_handicap_patient'));
    }

    /**
     * Update the specified DossierPatient in storage.
     */
    public function update($id, UpdateDossierPatientRequest $request)
    {
        $data = $request->all();
        $dossierPatient = $this->dossierPatientRepository->where(DossierPatient::class,'numero_dossier',$id)->first();
    
        if (empty($dossierPatient)) {
            Flash::error(__('models/dossierPatients.singular') . ' ' . __('messages.not_found'));
            return redirect(route('dossier-patients.index'));
        }
    
        $dossierPatientID = $dossierPatient->id;
        $typeHandicapIDs = $data['type_handicap_id'];
    
        DossierPatient_typeHandycape::where('dossier_patient_id', $dossierPatientID)
            ->whereNotIn('type_handicap_id', $typeHandicapIDs)
            ->delete();
    
        foreach ($typeHandicapIDs as $typeHandicapID) {
            DossierPatient_typeHandycape::updateOrCreate(
                ['dossier_patient_id' => $dossierPatientID, 'type_handicap_id' => $typeHandicapID],
                ['type_handicap_id' => $typeHandicapID]
            );
        }
    
        $dossierPatient = $this->dossierPatientRepository->update($data, $id);
        Flash::success(__('messages.updated', ['model' => __('models/dossierPatients.singular')]));
        return redirect(route('dossier-patients.index'));
    }
    
    

    /**
     * Remove the specified DossierPatient from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $dossierPatient = $this->dossierPatientRepository->where(DossierPatient::class,'numero_dossier',$id)->first();

        $dossierPatientID = $dossierPatient->id;
        if ($dossierPatient) {
            $OrientationExterne = OrientationExterne::where('dossier_patient_id', $dossierPatientID)->first();
            $dossierPatientConsultation = DossierPatientConsultation::where('dossier_patient_id', $dossierPatientID)->first();
            $DossierPatient_typeHandycape = DossierPatient_typeHandycape::where('dossier_patient_id', $dossierPatientID)->first();
        
            if ($OrientationExterne) {
                Flash::error(__('messages.cannotDeleted', ['model' => __('models/dossierPatients.OrientationExterne')]));
            } else {
                if ($dossierPatientConsultation) {
                    Flash::error(__('messages.cannotDeletedEnCounsultation', ['model' => __('models/dossierPatients.enconsultation')]));
                } else {
                    if ($DossierPatient_typeHandycape) {
                        $DossierPatient_typeHandycape->delete();
                    }
                    
                    $this->dossierPatientRepository->delete($dossierPatientID);
                    Flash::success(__('messages.deleted', ['model' => __('models/dossierPatients.singular')]));
                }
            }
        }
        
        if (empty($dossierPatient)) {
            Flash::error(__('models/dossierPatients.singular') . ' ' . __('messages.not_found'));
        }

        return redirect(route('dossier-patients.index'));
    }

    public function parent(Request $request)
    {
        $query = $request->input('query');
        $tuteurRepository = new TuteurRepository;
        $tuteurs  =  $tuteurRepository->paginate($query);
        return view('dossier_patients.parent', compact("tuteurs"));
    }
    public function patient(Request $request)
    {

        $query = $request->input('query');

        $patientRepository = new PatientRepository;
        $patients  =  Patient::where("tuteur_id", $request->parentRadio)->get();
        return view('dossier_patients.patient', compact("patients"));
    }
    public function entretien(Request $request)
    {
        $couverture_medical = CouvertureMedical::all();
        $type_handicap = TypeHandicap::all();
        return view('dossier_patients.entretien', compact('type_handicap', 'couverture_medical'));
    }
    public function export()
    {
    return Excel::download(new ExportDossierPatient, 'dossierpatients.xlsx');
    }


    public function import(Request $request)
    {
        $file = $request->file('file');
        
        if ($file) {
            $path = $file->store('files');
            Excel::import(new ImportDossierPatientGlobal, $path);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/dossierPatients.singular')]));
        
        return redirect()->back();
    }
}