<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class RendezVousTest extends CnmhDuskTest
{

    /**
     * @group list-attente
     */
    public function testInsertionAutomatiqueEnListAttente(): void{

        // Prepare data
        // Ajouter entretien social


        
        $this->browse(function (Browser $browser) {

            login_service_social($browser);

            // Traitement
            $browser->visit('/consultations/liste-attente');
            $browser->type('#searchConsultation','Madani');
            // $this->press('');

            // Assertion
            $browser-assertSee('Madani');
            $browser-assertSee('Ali');
 
        });
    }


    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
                    // ->assertSee('Laravel');
        });
    }
}
