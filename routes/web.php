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
Route::resource('projects',App\Http\Controllers\ProjectController::class);
// Route::resource('tasks',App\Http\Controllers\TaskController::class);
// Route::resource('members',App\Http\Controllers\MemberController::class);
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
Route::resource('patients', App\Http\Controllers\PatientController::class);
Route::resource('dossier-patients', App\Http\Controllers\DossierPatientController::class);
Route::resource('orientation-externes', App\Http\Controllers\OrientationExterneController::class);

//consultation
Route::get('/consultations/{model}', [ConsultationController::class, 'index'])->middleware(['ModelExists'])->name('consultations.index');
Route::get('/consultations/create/{model}',[ConsultationController::class,'create'])->middleware(['ModelExists'])->name('consultations.create');
Route::post('/consultations/store/{model}',[ConsultationController::class,'store'])->middleware(['ModelExists'])->name('consultations.store');
Route::delete('/consultations/{id}',[ConsultationController::class,'destroy'])->name('consultations.destroy');
Route::get('/consultations/show/{model}/{id}',[ConsultationController::class,'show'])->middleware(['ModelExists'])->name('consultations.show');
Route::get('/consultations/edit',[ConsultationController::class,'edit'])->name('consultations.edit');
Route::post('/consultations/update',[ConsultationController::class,'update'])->name('consultations.update');

Route::get('/consultations/rendezVous/{model}', [ConsultationController::class, 'Ajouter_RendezVous'])->middleware(['ModelExists'])->name('consultations.rendezVous');
Route::get('/consultations/patient/{model}', [ConsultationController::class, 'patient'])->middleware(['ModelExists'])->name('consultations.patient');




// Route::resource('rendez-vouses', App\Http\Controllers\RendezVousController::class);
Route::get('/rendez-vous',[RendezVousController::class,'index'])->name('rendez-vous.index');
Route::get('/rendez-vous/list_dossier',[RendezVousController::class,'list_dossier'])->name('rendez-vous.list_dossier');
Route::post('rendez-vous/createe',[RendezVousController::class,'create'])->name('rendez-vous.create');
Route::delete('rendez-vous/destroy/{id}',[RendezVousController::class,'destroy'])->name('rendez-vous.destroy');
Route::get('rendez-vous/show/{id}',[RendezVousController::class,'show'])->name('rendez-vous.show');
Route::get('rendez-vous/edit/{id}',[RendezVousController::class,'edit'])->name('rendez-vous.edit');
Route::post('rendez-vous/store',[RendezVousController::class,'store'])->name('rendez-vous.store');

Route::prefix('/root')->group(function() {
    Route::controller(RootController::class)->group(function() {
        Route::get('/', 'index');
    });
    Route::resource('menu-items', App\Http\Controllers\Root\MenuItemController::class);
    Route::resource('menu-groups', App\Http\Controllers\Root\MenuGroupController::class);
});

Route::resource('tuteurs', App\Http\Controllers\TuteurController::class);

Route::get('/parentForm',[DossierPatientController::class,'parent'])->name('dossier-patients.parent');
Route::get('/patientForm',[DossierPatientController::class,'patient'])->name('dossier-patients.patient');
Route::get('/entretien/{query}',[DossierPatientController::class,'entretien'])->name('dossier-patients.entretien');
Route::post('/storeEntetien',[DossierPatientController::class,'storeEntetien'])->name('dossier-patients.storeEntetien');
Route::get('/export',[DossierPatientController::class,'export'] )->name('dossier-patients.export');
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
Route::get('/manage/permissions-roles/{id}', [App\Http\Controllers\PermissionController::class, 'showRolePermission'])->name('manage.role.permission');
Route::post('/assign-role-permission', [App\Http\Controllers\PermissionController::class, 'assignRolePermission'])->name('assign.role.permission');