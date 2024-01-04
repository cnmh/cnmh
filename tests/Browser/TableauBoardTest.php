<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class TableauBoardTest extends CnmhDuskTest
{
 
    public function testStatistiques(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
                    // ->assertSee('Laravel');
        });
    }
}
