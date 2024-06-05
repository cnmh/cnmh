<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Consultation\ConsultationController;

Route::prefix('Orthophoniste')->group(function () {
   // List des consultation et editer et supprimer et consulter la consultation
Route::get('/',[ConsultationController::class, 'list_consultations'])->name('Orthophoniste.list');
Route::get('/Consultations/Consultation/{consultationID}',[ConsultationController::class, 'show'])->name('Orthophoniste.consulter');
Route::get('/Consultations/{consultationID}/edit',[ConsultationController::class, 'edit'])->name('Orthophoniste.formEdit');
Route::patch('/Consultations/{consultationID}/update',[ConsultationController::class, 'update'])->name('Orthophoniste.modifier');
Route::delete('/Consultations/{consultationID}/delete',[ConsultationController::class, 'destroy'])->name('Orthophoniste.supprimer');

// Phase 1 = choix un dossier bénéficiaire dans rendez vous
Route::get('/Consultations/Rendez-Vous',[ConsultationController::class, 'list_rendezVous'])->name('Orthophoniste.rendezvous');
Route::get('/Consultations/Choix-Rendez-Vous',[ConsultationController::class, 'SelectRendezVous'])->name('Orthophoniste.rendezvous-select');

// Phase 2 = voir les informations de bénéficiaire
Route::get('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire',[ConsultationController::class, 'InformationPatient'])->name('Orthophoniste.patientInformation');

// Phase 3 = Ajouter un consultation
Route::get('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation', [ConsultationController::class, 'FormAjouterConsultation'])->name('Orthophoniste.FormAjouterConsultation');
Route::post('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation/ajouter', [ConsultationController::class, 'AjouterConsultation'])->name('Orthophoniste.AjouterConsultation');
Route::get('/suiver-seance',[ConsultationController::class, 'seance'])->name('Orthophoniste.seance');
Route::post('/suiver-seance/{id}/update-present',[ConsultationController::class, 'presentSeance'])->name('Orthophoniste.seancePresent');
Route::post('/suiver-seance/{id}/update-absent',[ConsultationController::class, 'absentSeance'])->name('Orthophoniste.seanceAbsent');
Route::get('/dossiers-patients',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'list_dossier'])->name('dossier-patients.Orthophoniste');


});