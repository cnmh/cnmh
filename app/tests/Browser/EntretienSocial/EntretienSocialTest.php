<?php

namespace Tests\Browser;

use App\Models\Patient;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\Dossier_patient_service;
use App\Models\DossierPatient_typeHandycape;

use App\Models\Consultation;
use App\Models\Tuteur;
use App\Models\User;
use Tests\Browser\CnmhDuskTest;
use App\Models\CouvertureMedical;
use Tests\Browser\ListAttenteTest;
use App\Repositories\DossierPatientRepository;
use Illuminate\Support\Carbon;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;


class EntretienSocialTest extends CnmhDuskTest
{
    // use DatabaseTruncation;



    /**
     * @group entretien-social
     */
    public function testAjouterEntretienSocial(): void
    {
 
        $this->browse(function (Browser $browser) {
            
        
        
            
        $this->login_service_social($browser);



        $this->ajouter_entretien_social_not_existe();




            // Navigation
            $browser->clickLink('Dossier bénéficiaires');
            $browser->visit('/dossier-patients');
            $browser->clickLink('Ajouter');
            $browser->visit('/parentForm');
            $browser->assertPathIs('/parentForm');

            // Ajouter tuteur
            $browser->clickLink('Ajouter tuteur');
            $browser->type('nom', 'NomTuteur1');
            $browser->type('prenom', 'PrénomTuteur1');
            $browser->select('etat_civil_id','1');
            $browser->select('sexe','homme');
            $browser->type('telephone', '1010101010');
            $browser->type('adresse', 'Tanger Maroc branes');
            $browser->type('cin', 'k00004');
            $browser->press('Enregistrer');
            $browser->assertPathIs('/patientForm');

            // Ajouter bénéficiaire
            $browser->clickLink('Ajouter bénéficiaire');
            $browser->type('nom', 'Madani');
            $browser->type('prenom', 'Ali');
            $browser->select('niveau_scolaire_id','1');
            $browser->press('Enregistrer');
            $browser->assertSee('bénéficiaire a été enregistré avec succès.');
            // $browser->assertPathIs('/entretien/parentRadio=4');
            // TODO : assert by path

            // Entretien social
            $browser->select('type_handicap_id[]',[1,2]);
            $browser->select('services_id[]',[1,2]);
            $browser->select('couverture_medical_id','1');
            $browser->press('Enregistrer');
            $browser->assertPathIs('/dossier-patients');

            // TODO: Fixed Assert: Added tuteur, patient, Dossier patient, consultation, dossierpatientconsultation, dossierpatientservice, dossierpatient typeshendicap
            $this->assertDatabaseHas('tuteurs', [
                'nom' => 'NomTuteur1',
                'prenom' => 'PrénomTuteur1',
            ]);
            $this->assertDatabaseHas('patients', [
                'nom' => 'Madani',
                'prenom' => 'Ali',
            ]);
            // get patient 
            $patient = Patient::where(['nom' => 'Madani', 'prenom' => 'Ali'])->first();
            $this->assertDatabaseHas('dossier_patients', [
                'patient_id' => $patient->id,
            ]);

            $dossier_patient = DossierPatient::where('patient_id', $patient->id)->first();
            $this->assertDatabaseHas('dossier_patient_consultation', [
                'dossier_patient_id' => $dossier_patient->id,
            ]);

            $dossier_patient_consultation = DossierPatientConsultation::where('dossier_patient_id', $dossier_patient->id)->first();
            $this->assertDatabaseHas('consultations', [
                'id' => $dossier_patient_consultation->consultation_id,
            ]);




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