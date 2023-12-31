<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class CnmhDuskTestCase extends DuskTestCase
{
    /// use DatabaseTruncation;
    //  use RefreshDatabase;

    
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


    protected static $migrate_fresh = false;
    protected static $db_seed = false;

    protected function setUp(): void{
        parent::setUp();
        
        // init database one time by test session seed one time
        if(!static::$migrate_fresh){
            // php artisan migrate:fresh
            $this->artisan('migrate:fresh');
            $migrate_fresh = true;
        }

        if(!static::$db_seed){
            // php artisan db:seed 
            $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
            static::$db_seed = true;
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
