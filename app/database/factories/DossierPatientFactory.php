<?php

namespace Database\Factories;

use App\Models\DossierPatient;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\CouvertureMedical;
use App\Models\Patient;
use App\Models\User;

class DossierPatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DossierPatient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'patient_id' => $this->faker->randomElement(Patient::pluck("id")),
            'patient_id' => $this->faker->randomElement(Patient::pluck("id")),
            'user_id' => $this->faker->randomElement(User::pluck("id")),
            'couverture_medical_id' => $this->faker->randomElement(CouvertureMedical::pluck("id")),
            'numero_dossier' => $this->faker->numberBetween(5, 255),
            'etat' => $this->faker->word,
            'date_enregsitrement' => $this->faker->date('Y-m-d'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
