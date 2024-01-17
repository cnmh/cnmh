<?php

namespace App\Http\Controllers\Consultation;

use App\Http\Requests\CreateConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Consultation;
use App\Models\DossierPatient;
use App\Models\DossierPatientConsultation;
use App\Models\RendezVous;
use App\Models\DossierPatient_typeHandycape;
use App\Models\Dossier_patient_service;
use App\Models\TypeHandicap;
use App\Models\Service;
use App\Models\Consultation_service;
use App\Models\Consultation_type_handicap;

use App\Repositories\ConsultationRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportConsultation;
use App\Imports\ImportConsultation;
use Illuminate\Support\Facades\Auth;



class ConsultationController extends AppBaseController
{
   

    // List des consultations
    public function list_consultations(){


    }

    // Choissir le rendez-vous pour pouvoir d'ajoute un consultation
    public function SelectRendezVous(){

    }


    // Affichage des informations de patient
    public function InformationPatient(){

    }

    // Form pour ajouter la consultation
    public function FormAjouterConsultation(){

    }

    // Ajouter la consultation
    public function AjouterConsultation(Request $request){

    }

    // Form pour editer la consultation
    public function edit($id){

    }

    // update consultation
    public function update(Request $request, $id){

    }

    // Supprimer consultation
    public function destroy($id){

    }

    

   
}
