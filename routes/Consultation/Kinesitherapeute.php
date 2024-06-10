<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Consultation\ConsultationController;

Route::prefix('Kinesitherapeute')->group(function () {
   // List des consultation et editer et supprimer et consulter la consultation
Route::get('/',[ConsultationController::class, 'list_consultations'])->name('Kinesitherapeute.list');
Route::get('/Consultations/Consultation/{consultationID}',[ConsultationController::class, 'show'])->name('Kinesitherapeute.consulter');
Route::get('/Consultations/{consultationID}/edit',[ConsultationController::class, 'edit'])->name('Kinesitherapeute.formEdit');
Route::patch('/Consultations/{consultationID}/update',[ConsultationController::class, 'update'])->name('Kinesitherapeute.modifier');
Route::delete('/Consultations/{consultationID}/delete',[ConsultationController::class, 'destroy'])->name('Kinesitherapeute.supprimer');

// Phase 1 = choix un dossier bénéficiaire dans rendez vous
Route::get('/Consultations/Rendez-Vous',[ConsultationController::class, 'list_rendezVous'])->name('Kinesitherapeute.rendezvous');
Route::get('/Consultations/Choix-Rendez-Vous',[ConsultationController::class, 'SelectRendezVous'])->name('Kinesitherapeute.rendezvous-select');

// Phase 2 = voir les informations de bénéficiaire
Route::get('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire',[ConsultationController::class, 'InformationPatient'])->name('Kinesitherapeute.patientInformation');

// Phase 3 = Ajouter un consultation
Route::get('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation', [ConsultationController::class, 'FormAjouterConsultation'])->name('Kinesitherapeute.FormAjouterConsultation');
Route::post('/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation/ajouter', [ConsultationController::class, 'AjouterConsultation'])->name('Kinesitherapeute.AjouterConsultation');
Route::get('/suiver-seance',[ConsultationController::class, 'seance'])->name('Kinesitherapeute.seance');
Route::post('/suiver-seance/{id}/update-present',[ConsultationController::class, 'presentSeance'])->name('Kinesitherapeute.seancePresent');
Route::post('/suiver-seance/{id}/update-absent',[ConsultationController::class, 'absentSeance'])->name('Kinesitherapeute.seanceAbsent');
Route::get('/dossiers-patients',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'list_dossier'])->name('dossier-patients.Kinesitherapeute');


});