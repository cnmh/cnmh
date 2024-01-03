<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
// use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class EntretienSocialTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic unit test ajouter tuteur.
     */
    public function test_ajouter_tuteur(): void
    {

        $user = User::where('email', 'social@gmail.com')->first();

        $this->actingAs($user);

        $response = $this->post(route('tuteurs.store'), [
            'etat_civil_id' => '1',
            'nom' => 'nom Tuteur',
            'prenom' => 'prenom Tuteur',
            'sexe' => 'HOMME',
            'telephone' => 'remarques test',
            'email' => 'tuteur@gmail.com',
            'adresse' => 'tanja balia',
            'cin' => 'KB0098',
            'remarques' => 'remarques de tuteur',
        ]);

        $this->assertDatabaseHas('tuteurs', [
            'email' => 'tuteur@gmail.com'
        ]);

        $response->assertStatus(302);
    }
}



