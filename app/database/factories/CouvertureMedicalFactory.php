<?php

namespace Database\Factories;

use App\Models\CouvertureMedical;
use Illuminate\Database\Eloquent\Factories\Factory;


class CouvertureMedicalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CouvertureMedical::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'nom' => $this->faker->name,
            'description' => $this->faker->text($this->faker->numberBetween(5, 100)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
