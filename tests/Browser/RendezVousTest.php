<?php

namespace Tests\Browser;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Patient;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\Consultation;
use App\Models\DossierPatient;
use Tests\Browser\CnmhDuskTest;
use App\Models\CouvertureMedical;
use Tests\Browser\ListAttenteTest;
use App\Models\Dossier_patient_service;
use App\Models\DossierPatientConsultation;
use App\Models\DossierPatient_typeHandycape;
use App\Repositories\DossierPatientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class RendezVousTest extends CnmhDuskTest
{


    /**
     * @group ajouter-rendez-vous
     */
    public function test_ajouter_rendez_vous(){

        $this->browse(function (Browser $browser) {
            $this->ajouter_entretien_social_not_existe();

            $this->login_service_social($browser);

            // Navigation
            $browser->visit('/rendez-vous');
            $browser->visit('/rendez-vous/list_dossier');

            $browser->radio('consultation_id', '1');
            $browser->press('Suivant');
            
            $browser->type('date_rendez_vous', '2024-01-04T13:36');
            $browser->press('Enregistrer');

            $browser->assertSee('Rendez vous a été enregistré avec succès.');

            $this->assertDatabaseHas('rendez_vous', [
                'id' => '1',
            ]);
        });

    }








    public function ajouter_entretien_social_not_existe(){

        // Get the last data from data base
        $patient = Patient::first();
        $couvertureMedical = CouvertureMedical::first();
        $user = User::where('email','social@gmail.com')->first();
        $etat = "enAttente";
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
