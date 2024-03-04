<?php

namespace Database\Factories;

use App\Models\NiveauScolaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class NiveauScolaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NiveauScolaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // return [
        //     'nom' => $this->faker->name(),

        //     'description' => $this->faker->text($this->faker->numberBetween(5, 255)),
        //     'created_at' => $this->faker->date('Y-m-d H:i:s'),
        //     'updated_at' => $this->faker->date('Y-m-d H:i:s')
        // ];
    }
}
