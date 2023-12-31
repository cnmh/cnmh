<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class EntretienSocialTest extends CnmhDuskTest
{
    // use DatabaseTruncation;



    public function testAjouterEntretienSocial(): void
    {
 
        $this->browse(function (Browser $browser) {

             
            $this->login_service_social($browser);

            // Navigation
            $browser->clickLink('Dossier bénéficiaires');
            $browser->visit('/dossier-patients');
            $browser->clickLink('Ajouter');
            $browser->visit('/parentForm');

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
            $browser->assertPathIs('/entretien/parentRadio=4');

            // Entretien social
            $browser->select('type_handicap_id[]',[1,2]);
            $browser->select('services_id[]',[1,2]);
            $browser->select('couverture_medical_id','1');
            $browser->press('Enregistrer');
            $browser->assertPathIs('/dossier-patients');
        });
    }


    /**
     * @group list-attente
     */
    public function testInsertionAutomatiqueEnListAttente(): void{

        // Prepare data
        // Ajouter entretien social


        
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

    
}
