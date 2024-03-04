<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use App\Models\Consultation;
use App\Models\DossierPatient;
use App\Models\Patient;
use App\Models\Tuteur;
use App\Models\User;
use Tests\Browser\CnmhDuskTest;
use App\Models\CouvertureMedical;
use Tests\Browser\ListAttenteTest;
use App\Models\Dossier_patient_service;
use App\Models\DossierPatientConsultation;
use App\Models\DossierPatient_typeHandycape;
use App\Repositories\DossierPatientRepository;
use Illuminate\Support\Carbon;




class ConsultationMedecinGeneralTest extends CnmhDuskTest
{

    /**
     * @group ajouter-consultation
    */
    public function testAjouterConsultation(): void
    {
        $this->browse(function (Browser $browser) {

            $this->test_ajouter_rendez_vous();

            $this->login_medecin($browser);

            $browser->visit('/consultations/MedecinGeneral');

            $browser->visit('/consultations/rendezVous/MedecinGeneral');

            $consultation = Consultation::find(6);
        
            $DossierPatient_consultation = DossierPatientConsultation::where('consultation_id', $consultation->id)->first();

            $dossier_patient = DossierPatient::where('id', $DossierPatient_consultation->dossier_patient_id)->first();
        
            $browser->radio('dossier_patients', $dossier_patient->id);

            $browser->press('Suivant');

            $browser->visit('/consultations/patient/MedecinGeneral?dossier_patients=' . $dossier_patient->id . '&consultation_id='. $consultation->id);

            $browser->visit('/consultations/create/MedecinGeneral?dossier_patients=' . $dossier_patient->id . '&consultation_id='. $consultation->id);
            $now = \Carbon\Carbon::now();

            $browser->value('input[name="date_enregistrement"]', now()->format('Y-m-d\TH:i:s'));

            $browser->select('#type_handicap_select', [1, 2]);
            $browser->select('#services_select', [2, 3]);
    
            $browser->value('input[name="consultation_id"]', $consultation->id);
            $browser->value('textarea[name="observation"]', 'test observation');
            $browser->value('textarea[name="diagnostic"]', 'test diagnostic');
            $browser->value('textarea[name="bilan"]', 'test bilan');
            $browser->value('input[name="dossier_patients"]', $dossier_patient->id);
    
            $browser->press('Enregistrer');
            $browser->visit('/consultations/MedecinGeneral');

            $consultation = Consultation::find($consultation->id);

            $consultation->update([
                'etat' => 'enConsultation'
            ]);

            $etat = 'enConsultation';
            $this->assertDatabaseHas('consultations', [
                'id' => $consultation->id,
                'etat' => $etat
            ]);
        });
    }

    public function test_ajouter_rendez_vous(){

        $this->browse(function (Browser $browser) {
            $this->login_service_social($browser);
            $this->ajouter_entretien_social_not_existe();

            // Navigation
            $browser->visit('/rendez-vous');
            $browser->visit('/rendez-vous/list_dossier');

            // traitement
            $etat = "entretien social";
            $dossierPatient = DossierPatient::where('etat', $etat)->orderBy('created_at', 'desc')->first();
            $DossierPatient_consultation = DossierPatientConsultation::where('dossier_patient_id',$dossierPatient->id)->first();
            $browser->radio('consultation_id', $DossierPatient_consultation->consultation_id);
            $browser->press('Suivant');
            $browser->type('date_rendez_vous', '2024-01-04T13:36');
            $browser->press('Enregistrer');
            $browser->assertSee('Rendez vous a été enregistré avec succès.');
            
            $this->assertDatabaseHas('rendez_vous', [
                'consultation_id' => $DossierPatient_consultation->consultation_id,
            ]);

            $browser->press('.nav-link.dropdown-toggle');
            $browser->press('.btn.btn-default.btn-flat.float-right');
        });

    }

    public function ajouter_entretien_social_not_existe(){

        // Get the last data from data base
        $patient = Patient::first();
        $couvertureMedical = CouvertureMedical::first();
        $user = User::where('email','social@gmail.com')->first();
        $etat = "entretien social";
        $now = \Carbon\Carbon::now();

       
       $dossierPatientRepository = new DossierPatientRepository;

       $latestDossier = DossierPatient::where('numero_dossier', 'like', 'A-%')
       ->whereRaw('CAST(SUBSTRING(numero_dossier, 3) AS SIGNED) IS NOT NULL')
       ->max('numero_dossier');

        $counter = $latestDossier ? (int)substr($latestDossier, 2) + 1 : 1802;

        $numeroDossier = 'A-' . $counter;

        $input['numero_dossier'] = $numeroDossier;

        // Traitement 
        $input = [
            'patient_id' => $patient->id,
            'couverture_medical_id' => $couvertureMedical->id,
            'numero_dossier' => $numeroDossier,
            'etat' => $etat,
            'date_enregsitrement' => $now,
            'romarque' => 'entrotien social test',
            'user_id' => $user->id,
        ];

        $patientId = $input['patient_id'];

        $dossierPatient = $dossierPatientRepository->create($input);

        $dossierPatient->save();
        
        $dossierPatient = DossierPatient::where('numero_dossier', $numeroDossier)->first();
        $DossierPatient_typeHandycape = new DossierPatient_typeHandycape;

        $typeHandycaps = [1,2];

        $typeHandycapeIDs = $typeHandycaps;
        
        foreach ($typeHandycapeIDs as $typeHandycapeID) {
            $DossierPatient_typeHandycape = new DossierPatient_typeHandycape;
            $DossierPatient_typeHandycape->type_handicap_id = $typeHandycapeID;
            $DossierPatient_typeHandycape->dossier_patient_id = $dossierPatient->id;
            $DossierPatient_typeHandycape->save();
        }

        $services_patient = [1,2];

        $service_ids = $services_patient;

        foreach($service_ids as $service_id){
            $service_patient_demander = new Dossier_patient_service;
            $service_patient_demander->service_id = $service_id;
            $service_patient_demander->dossier_patient_id = $dossierPatient->id;
            $service_patient_demander->save();
        }
    
        $consultation = new Consultation();
        $consultation->date_enregistrement= now();
        $consultation->type="medecinGeneral";
        $consultation->etat="enAttente";
        $consultation->save();

        $DossierPatient_consultation =  new DossierPatientConsultation;

        $DossierPatient_consultation->dossier_patient_id = $dossierPatient->id;
        $DossierPatient_consultation->consultation_id  = $consultation->id;
        $DossierPatient_consultation->save();

    }


    
}
