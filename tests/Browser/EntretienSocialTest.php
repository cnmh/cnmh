<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
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
            // add assert

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
            $this->assertDatabaseHas('tuteurs', [
                'nom' => 'NomTuteur1',
                'prenom' => 'PrénomTuteur1',
            ]);

            // Ajouter bénéficiaire
            $browser->clickLink('Ajouter bénéficiaire');
            $browser->type('nom', 'Madani');
            $browser->type('prenom', 'Ali');
            $browser->select('niveau_scolaire_id','1');
            $browser->press('Enregistrer');
            $browser->assertSee('bénéficiaire a été enregistré avec succès.');
            // $browser->assertPathIs('/entretien/parentRadio=4');
            $this->assertDatabaseHas('patients', [
                'nom' => 'Madani',
                'prenom' => 'Ali',
            ]);

            // TODO : assert by path


            // Entretien social
            $browser->select('type_handicap_id[]',[1,2]);
            $browser->select('services_id[]',[1,2]);
            $browser->select('couverture_medical_id','1');
            $browser->press('Enregistrer');
            $browser->assertPathIs('/dossier-patients');


            // TODO: Assert: Added tuteur , entretien social , list d'attente
            
            


        });
    }


   

    

    
}
