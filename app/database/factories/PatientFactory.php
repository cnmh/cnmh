<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\NiveauScolaire;
use App\Models\Tuteur;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'tuteur_id' =>  $this->faker->randomElement(Tuteur::pluck("id")),
            // 'niveau_scolaire_id' =>$this->faker->randomElement(NiveauScolaire::pluck("id")),
            // 'nom' => $this->faker->name(),
            // 'prenom' => $this->faker->name(),
            // 'telephone' => $this->faker->numerify('0##########'),
            // 'cin' => $this->faker->numerify('K######'),
            // 'email' => $this->faker->email,
            // 'image' =>  fake()->imageUrl(),
            // 'adresse' => $this->faker->text($this->faker->numberBetween(5, 20)),
            // 'remarques' => $this->faker->text($this->faker->numberBetween(5, 30)),
            // 'created_at' => $this->faker->date('Y-m-d H:i:s'),
            // 'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
