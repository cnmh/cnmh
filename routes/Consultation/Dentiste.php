<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Consultation\ConsultationController;

Route::prefix('Dentiste')->group(function () {
   // List des consultation et editer et supprimer et consulter la consultation
Route::get('/',[ConsultationController::class, 'list_consultations'])->name('Dentiste.list');
Route::get('/Consultations/Consultation/{consultationID}',[ConsultationController::class, 'show'])->name('Dentiste.consulter');
Route::get('/Consultations/{consultationID}/edit',[ConsultationController::class, 'edit'])->name('Dentiste.formEdit');
Route::patch('/Consultations/{consultationID}/update',[ConsultationController::class, 'update'])->name('Dentiste.modifier');
Route::delete('/Consultations/{consultationID}/delete',[ConsultationController::class, 'destroy'])->name('Dentiste.supprimer');

// Phase 1 = choix un dossier bénéficiaire dans rendez vous
Route::get('/Consultations/Rendez-Vous',[ConsultationController::class, 'list_rendezVous'])->name('Dentiste.rendezvous');
Route::get('/Consultations/Choix-Rendez-Vous',[ConsultationController::class, 'SelectRendezVous'])->name('Dentiste.rendezvous-select');

// Phase 2 = voir les informations de bénéficiaire
Route::get('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire',[ConsultationController::class, 'InformationPatient'])->name('Dentiste.patientInformation');

// Phase 3 = Ajouter un consultation
Route::get('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation', [ConsultationController::class, 'FormAjouterConsultation'])->name('Dentiste.FormAjouterConsultation');
Route::post('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation/ajouter', [ConsultationController::class, 'AjouterConsultation'])->name('Dentiste.AjouterConsultation');

Route::get('/suiver-seance',[ConsultationController::class, 'seance'])->name('Dentiste.seance');
Route::post('/suiver-seance/{id}/update-present',[ConsultationController::class, 'presentSeance'])->name('Dentiste.seancePresent');
Route::post('/suiver-seance/{id}/update-absent',[ConsultationController::class, 'absentSeance'])->name('Dentiste.seanceAbsent');




});