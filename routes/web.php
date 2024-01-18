<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EtatCivilController;
use App\Http\Controllers\Root\RootController;
use App\Http\Controllers\TypeHandicapController;
use App\Http\Controllers\DossierPatientController;
use App\Http\Controllers\NiveauScolaireController;
use App\Http\Controllers\CouvertureMedicalController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RolePermissionController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// couvertureMedicals


    Route::resource('couvertureMedicals', App\Http\Controllers\CouvertureMedicalController::class);
    Route::get('/export_couvertureMedicals', [CouvertureMedicalController::class, 'export'])->name('couvertureMedicals.export');
    Route::post('/import_couvertureMedicals', [CouvertureMedicalController::class, 'import'])->name('couvertureMedicals.import');

        Route::resource('typeHandicaps', App\Http\Controllers\TypeHandicapController::class);
    
        Route::resource('services', App\Http\Controllers\ServiceController::class);
        Route::get('/export_service', [App\Http\Controllers\ServiceController::class, 'export'])->name('services.export');
        Route::post('/import_service', [App\Http\Controllers\ServiceController::class, 'import'])->name('services.import');
    
        // Employees routes
        Route::resource('employes', App\Http\Controllers\EmployeController::class);
        Route::get('/export_employes', [App\Http\Controllers\EmployeController::class, 'export'])->name('employes.export');
        Route::post('/import_employes', [App\Http\Controllers\EmployeController::class, 'import'])->name('employes.import');
    
        Route::get('/export_typehandicap', [App\Http\Controllers\TypeHandicapController::class, 'export'])->name('typehandicap.export');
        Route::post('/import_typehandicap', [App\Http\Controllers\TypeHandicapController::class, 'import'])->name('typehandicap.import');
    
        Route::resource('niveauScolaires', App\Http\Controllers\NiveauScolaireController::class);
        Route::get('/export_niveauScolaires', [App\Http\Controllers\NiveauScolaireController::class, 'export'])->name('niveauScolaires.export');
        Route::post('/import_niveauScolaires', [App\Http\Controllers\NiveauScolaireController::class, 'import'])->name('niveauScolaires.import');
    
        Route::resource('etatCivils', App\Http\Controllers\EtatCivilController::class);
        // EtatCivil export and import
        Route::get('/export_etatCivils', [App\Http\Controllers\EtatCivilController::class, 'export'])->name('etatCivils.export');
        Route::post('/import_etatCivils', [App\Http\Controllers\EtatCivilController::class, 'import'])->name('etatCivils.import');
   




Route::resource('reclamations', App\Http\Controllers\ReclamationController::class);
Route::resource('fonctions', App\Http\Controllers\FonctionController::class);
Route::resource('patients', App\Http\Controllers\PoleSocial\PatientController::class);
Route::resource('dossier-patients', App\Http\Controllers\PoleSocial\DossierPatientController::class);
Route::resource('orientation-externes', App\Http\Controllers\OrientationExterneController::class);

//consultation
Route::get('/consultations/{model}', [ConsultationController::class, 'index'])->middleware(['ModelExists'])->name('consultations.index');
Route::get('/consultations/create/{model}',[ConsultationController::class,'create'])->middleware(['ModelExists'])->name('consultations.create');
Route::post('/consultations/store/{model}',[ConsultationController::class,'store'])->middleware(['ModelExists'])->name('consultations.store');
Route::delete('/consultations/{id}',[ConsultationController::class,'destroy'])->name('consultations.destroy');
Route::get('/consultations/show/{model}/{id}',[ConsultationController::class,'show'])->middleware(['ModelExists'])->name('consultations.show');
Route::get('/consultations/edit/{id}',[ConsultationController::class,'edit'])->name('consultations.edit');
Route::patch('/consultations/update/{id}',[ConsultationController::class,'update'])->name('consultations.update');

Route::get('/consultations/rendezVous/{model}', [ConsultationController::class, 'Ajouter_RendezVous'])->middleware(['ModelExists'])->name('consultations.rendezVous');
Route::get('/consultations/patient/{model}', [ConsultationController::class, 'patient'])->middleware(['ModelExists'])->name('consultations.patient');

Route::post('/consultations/patient/import', [ConsultationController::class, 'import'])->name('consultations.import');
Route::post('/consultations/patient/export', [ConsultationController::class, 'export'])->name('consultations.export');





// Route::resource('rendez-vouses', App\Http\Controllers\RendezVousController::class);
Route::get('/rendez-vous',[RendezVousController::class,'index'])->name('rendez-vous.index');
Route::get('/rendez-vous/list_dossier',[RendezVousController::class,'list_dossier'])->name('rendez-vous.list_dossier');
Route::post('rendez-vous/createe',[RendezVousController::class,'create'])->name('rendez-vous.create');
Route::delete('rendez-vous/destroy/{id}',[RendezVousController::class,'destroy'])->name('rendez-vous.destroy');
Route::get('rendez-vous/show/{id}',[RendezVousController::class,'show'])->name('rendez-vous.show');
Route::get('rendez-vous/edit/{id}',[RendezVousController::class,'edit'])->name('rendez-vous.edit');
Route::post('rendez-vous/store',[RendezVousController::class,'store'])->name('rendez-vous.store');
Route::PUT('rendez-vous/update/{id}', [RendezVousController::class, 'update'])->name('rendez-vous.update');


Route::prefix('/root')->group(function() {
    Route::controller(RootController::class)->group(function() {
        Route::get('/', 'index');
    });
    Route::resource('menu-items', App\Http\Controllers\Root\MenuItemController::class);
    Route::resource('menu-groups', App\Http\Controllers\Root\MenuGroupController::class);
});

Route::resource('tuteurs', App\Http\Controllers\PoleSocial\TuteurController::class);
// TODO: Route est bloque la creation de nouveau route
// Route::delete('/tuteurs/{id}', 'TuteurController@destroy')->name('tuteurs.destroy');

Route::get('/parentForm',[DossierPatientController::class,'parent'])->name('dossier-patients.parent');
Route::get('/patientForm',[DossierPatientController::class,'patient'])->name('dossier-patients.patient');
Route::get('/entretien/{query}',[DossierPatientController::class,'entretien'])->name('dossier-patients.entretien');
Route::post('/storeEntetien',[DossierPatientController::class,'storeEntetien'])->name('dossier-patients.storeEntetien');
Route::get('/export',[DossierPatientController::class,'export'] )->name('dossier-patients.export');
Route::post('/import',[DossierPatientController::class,'import'] )->name('dossier-patients.import');

});

/**
 * Roles links
 */

Route::resource('roles', App\Http\Controllers\RoleController::class); // ressource
Route::get('roles_export', [App\Http\Controllers\RoleController::class, 'export'])->name('roles.export'); // Export

/**
 * Permission links
 */
Route::resource('permissions', App\Http\Controllers\PermissionController::class);
Route::get('/ajouter/permission', [App\Http\Controllers\PermissionController::class,'addPermissionsAuto'])->name('auto-create-permissions');
Route::get('permissions_export', [App\Http\Controllers\PermissionController::class, 'export'])->name('permissions.export'); // Export
Route::post('/import_permissions', [App\Http\Controllers\PermissionController::class, 'import'])->name('permissions.import'); // Import


Route::resource('users', App\Http\Controllers\UserController::class);
Route::post('/user/export',[App\Http\Controllers\UserController::class,'export'])->name('users.export');
Route::post('/user/import',[App\Http\Controllers\UserController::class,'import'])->name('users.import');
Route::get('/user/{id}/password/initialiser',[App\Http\Controllers\UserController::class,'InitialiserMtp'])->name('users.initialiserMtp');



Route::get('/manage/permissions-roles/{id}', [App\Http\Controllers\PermissionController::class, 'showRolePermission'])->name('manage.role.permission');
Route::post('/assign-role-permission', [App\Http\Controllers\PermissionController::class, 'assignRolePermission'])->name('assign.role.permission');

Route::get('/get-permissions-action',[App\Http\Controllers\PermissionController::class, 'getPermissionsAction'])->name('get.permissions.action');
Route::get('/get-permissions-action/{id}',[App\Http\Controllers\PermissionController::class, 'userAssignedPermissions'])->name('get.role.permission');



// Routage : Sprint3

//   /pôle-social/entretien-social/ 
//   /pôle-social/entretien-social/tuteur  -> phase 1  : action : choixTuteur
//   /pôle-social/entretien-social/bénéficiaire  -> phase 1  : action : choixBéné
//   /pôle-social/entretien-social/enquette 


/**
 * Routage entretien social
*/
// Routage entretien social phase de tuteur
Route::get('/pôle-social/entretien-social/choix/tuteur',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'FormSelectTuteur'])->name('dossier-patients.tuteur');
Route::get('/pôle-social/entretien-social/tuteur/selected',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'SelectTuteur'])->name('Select.tuteurs');
Route::get('/pôle-social/entretien-social/tuteur/ajouter',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'FormAjouteTuteur'])->name('FormAjoute.tuteurs');
Route::post('/pôle-social/entretien-social/tuteur/ajouter',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'AjouteTuteur'])->name('Ajoute.tuteurs');
// Routage entretien social phase de bénéficiaire
Route::get('/pôle-social/entretien-social/tuteur/{tuteur_id}/bénéficiaire',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'FormSelectPatient'])->name('FormSelect.bénéficiaires');
Route::get('/pôle-social/entretien-social/bénéficiaire/selected',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'SelectPatient'])->name('Select.bénéficiaires');
Route::get('/pôle-social/entretien-social/tuteur/{tuteurID}/bénéficiaire/ajouter',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'FormAjoutePatient'])->name('FormAjoute.bénéficiaires');
Route::post('/pôle-social/entretien-social/bénéficiaire/ajouter',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'AjoutePatient'])->name('Ajoute.bénéficiaires');
// Routage entretien social phase de enquette social
Route::get('/pôle-social/entretien-social/{bénéficiaireID}/enquette',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'FormEntretienSocial'])->name('FormEntretienSocial');
Route::post('/pôle-social/entretien-social/bénéficiaire/{patientID}/enquette',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'AjouterEntretienSocial'])->name('AjouterEntretienSocial');
// List des dossier social
Route::get('/pôle-social/entretien-social/',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'list_dossier'])->name('dossier-patients.list');
Route::get('/pôle-social/entretien-social/dossier-bénéficiaire/{id}',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'show_dossier'])->name('dossier-patients.consulter');
Route::get('/pôle-social/entretien-social/dossier-bénéficiaire/{id}/editer',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'edit'])->name('dossier-patients.editer');
Route::PUT('/pôle-social/entretien-social/dossier-bénéficiaire/{id}/update',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'update'])->name('dossier-patients.modifier');
Route::delete('/pôle-social/entretien-social/dossier-bénéficiaire/{id}/delete',[App\Http\Controllers\PoleSocial\EntretienSocialController::class, 'destroy'])->name('dossier-patients.supprimer');


/**
 * Routage de consultation
*/

// List des consultation et editer et supprimer et consulter la consultation
Route::get('/Pôle-medical/{type}/Consultations',[App\Http\Controllers\PoleMedical\ConsultationController::class, 'list_consultations'])->name('consultations.list');
Route::get('/Pôle-medical/{type}/Consultations/Consultation/{consultationID}',[App\Http\Controllers\PoleMedical\ConsultationController::class, 'show'])->name('consultations.consulter');
Route::get('/Pôle-medical/{type}/Consultations/{consultationID}/edit',[App\Http\Controllers\PoleMedical\ConsultationController::class, 'edit'])->name('consultations.formEdit');
Route::patch('/Pôle-medical/{type}/Consultations/{consultationID}/update',[App\Http\Controllers\PoleMedical\ConsultationController::class, 'update'])->name('consultations.modifier');
Route::delete('/Pôle-medical/{type}/Consultations/{consultationID}/delete',[App\Http\Controllers\PoleMedical\ConsultationController::class, 'destroy'])->name('consultations.supprimer');

// Phase 1 = choix un dossier bénéficiaire dans rendez vous
Route::get('/Pôle-medical/{type}/Consultations/Rendez-Vous',[App\Http\Controllers\PoleMedical\ConsultationController::class, 'list_rendezVous'])->name('consultations.rendezvous');
Route::get('/Pôle-medical/{type}/Consultations/Choix-Rendez-Vous',[App\Http\Controllers\PoleMedical\ConsultationController::class, 'SelectRendezVous'])->name('consultations.rendezvous-select');

// Phase 2 = voir les informations de bénéficiaire
Route::get('/Pôle-medical/{type}/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire',[App\Http\Controllers\PoleMedical\ConsultationController::class, 'InformationPatient'])->name('consultations.patientInformation');

// Phase 3 = Ajouter un consultation
Route::get('/Pôle-medical/{type}/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation', [App\Http\Controllers\PoleMedical\ConsultationController::class, 'FormAjouterConsultation'])->name('consultations.FormAjouterConsultation');
Route::post('/Pôle-medical/{type}/Consultations/Choix-Rendez-Vous/dossier-bénéficiaire-id/{dossier_patient_id}/bénéficiaire/Form-consultation/ajouter', [App\Http\Controllers\PoleMedical\ConsultationController::class, 'AjouterConsultation'])->name('consultations.AjouterConsultation');




































