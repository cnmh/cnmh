<?php

namespace App\Repositories\Consultation;

use App\Models\Consultation\ConsultationOrthoptiste;
use App\Models\Consultation\Consultation;
use App\Repositories\BaseRepository;
use App\Models\DossierPatientConsultation;
use App\Models\Consultation\Seance;



class ConsultationOrthoptisteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'date_enregistrement',
        'date_consultation',
        'observation',
        'diagnostic',
        'type',
        'bilan'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function Consultation($type)
    {
        return DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
    ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
    ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
    ->where('consultations.type', $type)
    ->where('consultations.etat', '=', 'enConsultation')
    ->select(
        'dossier_patient_consultation.*',
        'consultations.id as consultation_id',
        'consultations.etat',
        'consultations.type',
        'consultations.date_consultation',
        'consultations.date_enregistrement',
        'patients.nom',
        'patients.prenom',
        'patients.telephone',
        'patients.id as patient_id',
        'dossier_patients.numero_dossier'
    )
    ->paginate();

    }
    

    public function ConsultationRendezVous($type){

        return  DossierPatientConsultation::join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
        ->join('consultations', 'dossier_patient_consultation.consultation_id', '=', 'consultations.id')
        ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
        ->where("consultations.etat","enRendezVous")
        ->where("consultations.type",$type)
        ->select('*')
        ->paginate();
    }

    public function ConsultationUpdate($input)
    {
        $consultationID = $input['consultation_id'];
    
        $consultation = Consultation::find($consultationID);
        $consultation->update([
            "date_enregistrement" => $input['date_enregistrement'],
            "date_consultation" => $input['date_consultation'],
            "observation" => $input['observation'],
            "diagnostic" => $input['diagnostic'],
            "bilan" => $input['bilan'],
            "etat" => Consultation::ETAT_CONSULTATION
        ]);
    
        for ($i = 1; $i <= $input['nombre_seance']; $i++) {
            $dateSeanceKey = 'date_seance' . $i;
            if (isset($input[$dateSeanceKey])) {
                $dateSeance = $input[$dateSeanceKey];
                $rendezVous = new RendezVous();
                $rendezVous->date_rendez_vous = $dateSeance;
                $rendezVous->consultation_id = $consultationID;
                $rendezVous->etat = 'Planifier';
                $rendezVous->save();

                $seance = new Seance();
                $seance->consultation_id = $consultationID;
                $seance->rendezVous_id = $rendezVous->id;
                $seance->etat = "";
                $seance->save();
            }
        }
    }

    public function seance($input) {
        $orientation = $input;
        return Seance::join('consultations', 'seances.consultation_id', '=', 'consultations.id')
        ->join('rendez_vous', 'seances.rendezVous_id', '=', 'rendez_vous.id')
        ->join('dossier_patient_consultation', 'consultations.id', '=', 'dossier_patient_consultation.consultation_id')
        ->join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
        ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
        ->where('consultations.type', $orientation)
        ->select('patients.nom', 'patients.prenom', 'dossier_patients.numero_dossier', 'rendez_vous.date_rendez_vous', 'seances.rendezVous_id', 'seances.etat')
        ->paginate();
    }

    public function searchData($search, $type)
    {
        return Seance::join('consultations', 'seances.consultation_id', '=', 'consultations.id')
            ->join('rendez_vous', 'seances.rendezVous_id', '=', 'rendez_vous.id')
            ->join('dossier_patient_consultation', 'consultations.id', '=', 'dossier_patient_consultation.consultation_id')
            ->join('dossier_patients', 'dossier_patient_consultation.dossier_patient_id', '=', 'dossier_patients.id')
            ->join('patients', 'dossier_patients.patient_id', '=', 'patients.id')
            ->where('consultations.type', $type)
            ->where(function ($query) use ($search) {
                $query->where('patients.nom', 'like', '%' . $search . '%')
                    ->orWhere('patients.prenom', 'like', '%' . $search . '%')
                    ->orWhere('dossier_patients.numero_dossier', 'like', '%' . $search . '%');
            })
            ->select('patients.nom', 'patients.prenom', 'dossier_patients.numero_dossier', 'rendez_vous.date_rendez_vous', 'seances.rendezVous_id', 'seances.etat')
            ->paginate();
    }

    public function seanceUpdate($etat,$id){
        $seance = Seance::find($id);
        return $seance->update([
            'etat' => $etat
        ]);
    }

    public function seanceEdit($id)
    {
        $seances = Seance::where('consultation_id', $id)->get();
        $rendezVous = [];
        foreach ($seances as $seance) {
            $rendezVous[] = RendezVous::find($seance->rendezVous_id);
        }
        return $rendezVous;
    }

    public function ConsultationModifier($input)
    {
        $consultation = Consultation::where('type',$input)->first();
    
        if ($consultation) {
            Seance::where('consultation_id', $consultation->id)->delete();
    
            $rendezVousIds = Seance::where('consultation_id', $consultation->id)->pluck('rendezVous_id')->toArray();
            RendezVous::whereIn('id', $rendezVousIds)->delete();
    
            $consultation->update([
                'etat' => Consultation::ETAT_EN_RENDEZVOUS
            ]);
        }
    }


    public function model(): string
    {
        return ConsultationOrthoptiste::class;
    }
}
