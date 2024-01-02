<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Patient;
use App\Models\DossierPatient;
use App\Models\CouvertureMedical;
use App\Models\DossierPatient_typeHandycape;
use App\Models\DossierPatientConsultation;


use App\Models\User;
use Illuminate\Support\Carbon;
use App\Repositories\DossierPatientRepository;

class ListAttenteTest extends CnmhDuskTest
{
    /**
     * A Dusk test example.
     */

    
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });



    }


    public function testInsertionAutomatiqueEnListAttente(): void{

      





    

        // TODO : ajouter entretien social
        
        $this->browse(function (Browser $browser) {

           $this->login_service_social($browser);

            // Traitement

            $browser->visit('/consultations/liste-attente');
            $browser->type('#searchConsultation','Madani');
            // $this->press('');

            // Assertion
            $browser->assertSee('Madani');
            $browser->assertSee('Ali');
 
        });
    }


    public function ajouter_entretien_social_not_existe(){

        // Get the last data from data base
        $patient = Patient::first();
        $couvertureMedical = CouvertureMedical::first();
        $user = User::where('email','social@gmail.com')->first();
        $etat = "enAttente";
        $now = \Carbon\Carbon::now();

        // Traitement 
        $input = [
            'patient_id' => $patient->id,
            'couverture_medical_id' => $couvertureMedical->id,
            'numero_dossier' => $numeroDossier,
            'etat' => $etat,
            'date_enregsitrement' => $now,
            'romarque' => null,
            'user_id' => $user->id,
        ];

        $patientId = $input['patient_id'];

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

        $service_ids = $request->input('services_id');

        foreach($service_ids as $service_id){
            $service_patient_demander = new Dossier_patient_service;
            $service_patient_demander->service_id = $service_id;
            $service_patient_demander->dossier_patient_id = $dossierPatient->id;
            $service_patient_demander->save();
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

    }


}
