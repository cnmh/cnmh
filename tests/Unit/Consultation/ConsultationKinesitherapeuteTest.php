<?php

namespace Tests\Unit\Consultation;

use App\Models\Consultation\ConsultationKinesitherapeute;
use App\Models\DossierPatientConsultation;
use App\Models\RendezVous;
use App\Models\Consultation;
use App\Models\Consultation\Seance;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\Consultation\ConsultationKinesitherapeuteRepository;
use App\Repositories\Consultation\ConsultationRepository;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;



class ConsultationKinesitherapeuteTest extends TestCase
{
    use DatabaseTransactions;

    protected $consultationRepository;
    protected $ConsultationKinesitherapeuteRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->ConsultationKinesitherapeuteRepository = new ConsultationKinesitherapeuteRepository();
        $this->consultationRepository = new ConsultationRepository();
    }

    public function testConsultationKinesitherapeute_paginate()
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
        $consultationKinesitherapeute = $this->ConsultationKinesitherapeuteRepository->Consultation('Kinesitherapeute');
        $this->assertNotNull($consultationKinesitherapeute);
    }


    public function testConsultationKinesitherapeute_rendezVous()
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

        $consultationKinesitherapeuteRendezVous = $this->ConsultationKinesitherapeuteRepository->ConsultationRendezVous('Kinesitherapeute');
        $this->assertNotNull($consultationKinesitherapeuteRendezVous);
    }


    public function test_consultationKinesitherapeuteUpdate(){
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

    public function test_consultationKinesitherapeuteSeanceListe(){

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

        $seances = $this->ConsultationKinesitherapeuteRepository->seance('Kinesitherapeute');
        $this->assertNotNull($seances);

    }

    public function test_consultationKinesitherapeuteSeanceUpdateEtat(){

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


    public function test_consultationKinesitherapeuteSeanceSearch(){

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

        $searchSeance = $this->ConsultationKinesitherapeuteRepository->searchData($searchValue,'Kinesitherapeute');
        $this->assertNotNull($searchSeance);
    }

}

