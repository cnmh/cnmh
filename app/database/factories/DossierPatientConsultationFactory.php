<?php

namespace Database\Factories;

use App\Models\Consultation;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DossierPatientConsultation>
 */
class DossierPatientConsultationFactory extends Factory
{
    protected $model = DossierPatientConsultation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dossier_patient_id' => $this->faker->randomElement(DossierPatient::pluck("id")),
            'consultation_id' => $this->faker->randomElement(Consultation::pluck("id")),
        ];
    }
}
