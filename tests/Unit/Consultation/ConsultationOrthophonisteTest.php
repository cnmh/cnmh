<?php

namespace Tests\Unit\Consultation;

use App\Models\Consultation\ConsultationOrthophoniste;
use App\Models\DossierPatientConsultation;
use App\Models\RendezVous;
use App\Models\Consultation;
use App\Models\Consultation\Seance;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\Consultation\ConsultationOrthophonisteRepository;
use App\Repositories\Consultation\ConsultationRepository;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;



class ConsultationOrthophonisteTest extends TestCase
{
    use DatabaseTransactions;

    protected $consultationRepository;
    protected $ConsultationOrthophonisteRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->ConsultationOrthophoniste = new ConsultationOrthophonisteRepository();
        $this->consultationRepository = new ConsultationRepository();
    }

    public function testConsultationOrthophoniste_paginate()
    {
      
        $consultationData = [
                'date_enregistrement' => '2024-06-05 10:00:00',
                'date_consultation' => '2024-06-05 10:00:00',
                'observation' => 'Observation 1',
                'diagnostic' => 'Diagnostic 1',
                'bilan' => 'Bilan 1',
                'etat' => 'enAttente',
                'created_at' => now(),
                'updated_at' => now()
        ];

        $this->consultationRepository->create($consultationData);   
        $consultationOrthophoniste = $this->ConsultationOrthophoniste->Consultation('Orthophoniste');
        $this->assertNotNull($consultationOrthophoniste);
    }


    public function testConsultationOrthophoniste_rendezVous()
    {
      
        $consultationData = [
                'date_enregistrement' => '2024-06-05 10:00:00',
                'date_consultation' => '2024-06-05 10:00:00',
                'observation' => 'Observation 1',
                'diagnostic' => 'Diagnostic 1',
                'bilan' => 'Bilan 1',
                'etat' => 'enRendezVous',
                'created_at' => now(),
                'updated_at' => now()
        ];

        $consultation = $this->consultationRepository->create($consultationData);   

        $rendezVousData = [
            'consultation_id' => $consultation->id,
            'date_rendez_vous' => '2024-06-30 10:00:00',
            'etat' => 'Planifier',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $consultationOrthophonisteRendezVous = $this->ConsultationOrthophoniste->ConsultationRendezVous('Orthophoniste');
        $this->assertNotNull($consultationOrthophonisteRendezVous);
    }


    public function test_consultationOrthophonisteUpdate(){
        $consultationData = [
                'date_enregistrement' => '2024-06-05 10:00:00',
                'date_consultation' => '2024-06-05 10:00:00',
                'observation' => 'Observation 1',
                'diagnostic' => 'Diagnostic 1',
                'bilan' => 'Bilan 1',
                'etat' => 'enRendezVous',
                'created_at' => now(),
                'updated_at' => now()
        ];

        $consultation = $this->consultationRepository->create($consultationData);   

        $consultationFind = $this->consultationRepository->find($consultation->id);   

        $dataUpdate = [
            "date_consultation" => '2024-06-05 10:00:00',
            "observation" => 'test',
            "diagnostic" => 'test',
            "bilan" => 'test',
            "etat" => 'enConsultation'
        ];

        $consultationFind->update($dataUpdate);

        $dateSeances = [
            'date_seance1' => '2024-06-05',
            'date_seance2' => '2024-06-12'
        ];

        $nombreSeance = 2;

        for ($i = 1; $i <= $nombreSeance; $i++) {
            $dateSeancesKey = 'date_seance' . $i;
            if (isset($input[$dateSeances])) {
                $dateSeance = $dateSeances[$dateSeancesKey];
                $rendezVous = new RendezVous();
                $rendezVous->date_rendez_vous = $dateSeance;
                $rendezVous->consultation_id = $consultation->id;
                $rendezVous->etat = 'Planifier';
                $rendezVous->save();

                $seance = new Seance();
                $seance->consultation_id = $consultation->id;
                $seance->rendezVous_id = $rendezVous->id;
                $seance->etat = "";
                $seance->save();

                $this->assertDatabaseHas('seances', ['rendezVous_id' => $rendezVous->id,'consultation_id' => $consultation->id]);

            }
        }

        $this->assertDatabaseHas('consultations', ['observation' => $dataUpdate['observation'],'etat' => 'enConsultation']);

    }

    public function test_consultationOrthophonisteSeanceListe(){

        $consultationData = [
            'date_enregistrement' => '2024-06-05 10:00:00',
            'date_consultation' => '2024-06-05 10:00:00',
            'observation' => 'Observation 1',
            'diagnostic' => 'Diagnostic 1',
            'bilan' => 'Bilan 1',
            'etat' => 'enConsultation',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $consultation = $this->consultationRepository->create($consultationData);   

        $dateSeances = [
            'date_seance1' => '2024-06-05',
            'date_seance2' => '2024-06-12'
        ];

        $nombreSeance = 2;

        for ($i = 1; $i <= $nombreSeance; $i++) {
            $dateSeancesKey = 'date_seance' . $i;
            if (isset($input[$dateSeances])) {
                $dateSeance = $dateSeances[$dateSeancesKey];
                $rendezVous = new RendezVous();
                $rendezVous->date_rendez_vous = $dateSeance;
                $rendezVous->consultation_id = $consultation->id;
                $rendezVous->etat = 'Planifier';
                $rendezVous->save();

                $seance = new Seance();
                $seance->consultation_id = $consultation->id;
                $seance->rendezVous_id = $rendezVous->id;
                $seance->etat = "";
                $seance->save();

                $this->assertDatabaseHas('seances', ['rendezVous_id' => $rendezVous->id,'consultation_id' => $consultation->id]);

            }
        }

        $this->assertDatabaseHas('consultations', ['observation' => $consultationData['observation'],'etat' => 'enConsultation']);

        $seances = $this->ConsultationOrthophoniste->seance('Orthophoniste');
        $this->assertNotNull($seances);

    }

    public function test_consultationOrthophonisteSeanceUpdateEtat(){

        $consultationData = [
            'date_enregistrement' => '2024-06-05 10:00:00',
            'date_consultation' => '2024-06-05 10:00:00',
            'observation' => 'Observation 1',
            'diagnostic' => 'Diagnostic 1',
            'bilan' => 'Bilan 1',
            'etat' => 'enConsultation',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $consultation = $this->consultationRepository->create($consultationData);
        $this->assertDatabaseHas('consultations', ['observation' => $consultationData['observation'],'etat' => 'enConsultation']);

        $dateSeances = [
            'date_seance1' => '2024-06-05',
            'date_seance2' => '2024-06-12'
        ];

        $nombreSeance = 2;

        for ($i = 1; $i <= $nombreSeance; $i++) {
            $dateSeancesKey = 'date_seance' . $i;
            if (isset($input[$dateSeances])) {
                $dateSeance = $dateSeances[$dateSeancesKey];
                $rendezVous = new RendezVous();
                $rendezVous->date_rendez_vous = $dateSeance;
                $rendezVous->consultation_id = $consultation->id;
                $rendezVous->etat = 'Planifier';
                $rendezVous->save();

                $seance = new Seance();
                $seance->consultation_id = $consultation->id;
                $seance->rendezVous_id = $rendezVous->id;
                $seance->etat = "";
                $seance->save();

                $this->assertDatabaseHas('seances', ['rendezVous_id' => $rendezVous->id,'consultation_id' => $consultation->id]);

                $seanceModel = new Seance();
                $seanceFind = $seanceModel->find($seance->id);

                $seanceFind->update([
                    'etat' => 'Absent'
                ]);

                $this->assertDatabaseHas('seances', ['id'=> $seance->id , 'etat' => 'Absent']);
            }
        }
    }


    public function test_consultationOrthophonisteSeanceSearch(){

        $consultationData = [
            'date_enregistrement' => '2024-06-05 10:00:00',
            'date_consultation' => '2024-06-05 10:00:00',
            'observation' => 'Observation 1',
            'diagnostic' => 'Diagnostic 1',
            'bilan' => 'Bilan 1',
            'etat' => 'enConsultation',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $consultation = $this->consultationRepository->create($consultationData);
        $this->assertDatabaseHas('consultations', ['observation' => $consultationData['observation'],'etat' => 'enConsultation']);

        $dateSeances = [
            'date_seance1' => '2024-06-05',
            'date_seance2' => '2024-06-12'
        ];

        $nombreSeance = 2;

        for ($i = 1; $i <= $nombreSeance; $i++) {
            $dateSeancesKey = 'date_seance' . $i;
            if (isset($input[$dateSeances])) {
                $dateSeance = $dateSeances[$dateSeancesKey];
                $rendezVous = new RendezVous();
                $rendezVous->date_rendez_vous = $dateSeance;
                $rendezVous->consultation_id = $consultation->id;
                $rendezVous->etat = 'Planifier';
                $rendezVous->save();

                $seance = new Seance();
                $seance->consultation_id = $consultation->id;
                $seance->rendezVous_id = $rendezVous->id;
                $seance->etat = "";
                $seance->save();

                $this->assertDatabaseHas('seances', ['rendezVous_id' => $rendezVous->id,'consultation_id' => $consultation->id]);

                $seanceModel = new Seance();
                $seanceFind = $seanceModel->find($seance->id);

                $seanceFind->update([
                    'etat' => 'Absent'
                ]);

                $this->assertDatabaseHas('seances', ['id'=> $seance->id , 'etat' => 'Absent']);
            }
        }

        $searchValue = 'ahmed';

        $searchSeance = $this->ConsultationOrthophoniste->searchData($searchValue,'Orthophoniste');
        $this->assertNotNull($searchSeance);
    }

}

