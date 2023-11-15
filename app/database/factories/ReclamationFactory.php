<?php

namespace Database\Factories;

use App\Models\Reclamation;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Patient;

class ReclamationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reclamation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'patient_id' => $this->faker->randomElement(Patient::pluck("id")),
            'objet' => $this->faker->text($this->faker->numberBetween(5, 191)),
            'reclamation' => $this->faker->text($this->faker->numberBetween(5, 191)),
            'date_reclamation' => $this->faker->date('Y-m-d H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
