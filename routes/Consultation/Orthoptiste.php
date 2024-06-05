<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Consultation\ConsultationController;

Route::prefix('Orthoptiste')->group(function () {
   // List des consultation et editer et supprimer et consulter la consultation
Route::get('/',[ConsultationController::class, 'list_consultations'])->name('Orthoptiste.list');
Route::get('/Consultations/Consultation/{consultationID}',[ConsultationController::class, 'show'])->name('Orthoptiste.consulter');
Route::get('/Consultations/{consultationID}/edit',[ConsultationController::class, 'edit'])->name('Orthoptiste.formEdit');
Route::patch('/Consultations/{consultationID}/update',[ConsultationController::class, 'update'])->name('Orthoptiste.modifier');
Route::delete('/Consultations/{consultationID}/delete',[ConsultationController::class, 'destroy'])->name('Orthoptiste.supprimer');

// Phase 1 = choix un dossier bénéficiaire dans rendez vous
Route::get('/Consultations/Rendez-Vous',[ConsultationController::class, 'list_rendezVous'])->name('Orthoptiste.rendezvous');
Route::get('/Consultations/Choix-Rendez-Vous',[ConsultationController::class, 'SelectRendezVous'])->name('Orthoptiste.rendezvous-select');

// Phase 2 = voir les informations de bénéficiaire
Route::get('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire',[ConsultationController::class, 'InformationPatient'])->name('Orthoptiste.patientInformation');

// Phase 3 = Ajouter un consultation
Route::get('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation', [ConsultationController::class, 'FormAjouterConsultation'])->name('Orthoptiste.FormAjouterConsultation');
Route::post('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation/ajouter', [ConsultationController::class, 'AjouterConsultation'])->name('Orthoptiste.AjouterConsultation');
Route::get('/suiver-seance',[ConsultationController::class, 'seance'])->name('Orthoptiste.seance');
Route::post('/suiver-seance/{id}/update-present',[ConsultationController::class, 'presentSeance'])->name('Orthoptiste.seancePresent');
Route::post('/suiver-seance/{id}/update-absent',[ConsultationController::class, 'absentSeance'])->name('Orthoptiste.seanceAbsent');
Route::get('/dossiers-patients',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'list_dossier'])->name('dossier-patients.Orthoptiste');


});