<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class CnmhDuskTest extends DuskTestCase
{
    use DatabaseTruncation;
    // use RefreshDatabase;

    
    /**
     * Indicates which tables should be excluded from truncation.
     */
     protected $exceptTables = [
        'users',
        'permissions',
        'model_has_roles',
        'model_has_permissions'
    ];


    // Indicates whether the default seeder should run before each test.
    //  protected $seed = true;


    protected static $seedRun = false;

    protected function setUp(): void{
        parent::setUp();

        // run seed one time
        if(!static::$seedRun){
            // $this->artisan('db:seed');
            $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
            static::$seedRun = true;
        }else{
            $this->artisan('db:seed', ['--class' => 'DatabaseSeederElsePermission']);
        }
    }


    public function login_service_social($browser):void{

         // Login
         $browser->visit('/login');
         $browser->type('email', 'social@gmail.com');
         $browser->type('password', 'social');
         // $browser->pause('5000');
         $browser->press('Connexion');
         $browser->assertPathIs('/');
    }
}
