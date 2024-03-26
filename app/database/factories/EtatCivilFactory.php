<?php

namespace Database\Factories;

use App\Models\EtatCivil;
use Illuminate\Database\Eloquent\Factories\Factory;


class EtatCivilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EtatCivil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // return [
        //     'nom' => $this->faker->name,
        //     'description' => $this->faker->text($this->faker->numberBetween(5, 255)),
        //     'created_at' => $this->faker->date('Y-m-d H:i:s'),
        //     'updated_at' => $this->faker->date('Y-m-d H:i:s')
        // ];
    }
}
