<?php

namespace Database\Factories;

use App\Models\Tuteur;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\EtatCivil;


class TuteurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tuteur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            // 'etat_civil_id' => $this->faker->randomElement(EtatCivil::pluck("id")),
            // 'nom' => $this->faker->name(),
            // 'prenom' => $this->faker->name(),
            // 'sexe' => $this->faker->text($this->faker->numberBetween(5, 7)),
            // 'telephone' => $this->faker->numerify('0##########'),
            // 'email' => $this->faker->email,
            // 'adresse' => $this->faker->text($this->faker->numberBetween(5, 30)),
            // 'cin' => $this->faker->text($this->faker->numberBetween(5, 10)),
            // 'remarques' => $this->faker->text($this->faker->numberBetween(5, 40)),
            // 'created_at' => $this->faker->date('Y-m-d H:i:s'),
            // 'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
