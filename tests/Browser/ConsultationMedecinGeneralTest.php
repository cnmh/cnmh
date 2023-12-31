<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class ConsultationMedecinGeneralTest extends CnmhDuskTestCase
{

    /**
     * A Dusk test example.
     */
    public function testAjouterConsultation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
                    // ->assertSee('Laravel');
        });
    }
}
