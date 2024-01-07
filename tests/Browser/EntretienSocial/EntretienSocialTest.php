<?php

namespace Tests\Browser;

use App\Models\Patient;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\Dossier_patient_service;
use App\Models\DossierPatient_typeHandycape;

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

            $dossier_patient_services_count = Dossier_patient_service::where('dossier_patient_id', $dossier_patient->id)->count();
            $this->assertDatabaseCount('dossier_patient_service', $dossier_patient_services_count);

            $dossier_patient_type_handicap_count = DossierPatient_typeHandycape::where('dossier_patient_id', $dossier_patient->id)->count();
            $this->assertDatabaseCount('dossier_patient_type_handicap', $dossier_patient_type_handicap_count);


        });
    }



    

    
}
