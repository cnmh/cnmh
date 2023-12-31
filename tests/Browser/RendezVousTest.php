<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class RendezVousTest extends CnmhDuskTest
{




    


    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
                    // ->assertSee('Laravel');
        });
    }
}
