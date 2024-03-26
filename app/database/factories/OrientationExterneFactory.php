<?php

namespace Database\Factories;

use App\Models\OrientationExterne;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\DossierPatient;
use App\Models\Service;

class OrientationExterneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrientationExterne::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        // $service = Service::first();
        // if (!$service) {
        //     $service = Service::factory()->create();
        // }

        return [
            'dossier_patient_id' => $this->faker->randomElement(DossierPatient::pluck("id")),
            'service_id' =>$this->faker->randomElement(Service::pluck("id")),
            'objet' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'date_orientation' => $this->faker->date('Y-m-d'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
