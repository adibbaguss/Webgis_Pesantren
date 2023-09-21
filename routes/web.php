<?php

use App\Http\Controllers\Admin_Kemenag\CategoryReportController;
use App\Http\Controllers\Admin_Kemenag\CreatePonpesController;
use App\Http\Controllers\Admin_Kemenag\DashboardController;
use App\Http\Controllers\Admin_Kemenag\DataAdminPesantrenController;
use App\Http\Controllers\Admin_Kemenag\DataPelaporController;
use App\Http\Controllers\Admin_Kemenag\DataPonpesController;
use App\Http\Controllers\Admin_Kemenag\DataStatistikController;
use App\Http\Controllers\Admin_Kemenag\MapViewController;
use App\Http\Controllers\Admin_Kemenag\PonpesViewController;
use App\Http\Controllers\Admin_Kemenag\ProfileController;
use App\Http\Controllers\Admin_Kemenag\ReportController;
use App\Http\Controllers\Admin_Kemenag\UpdatePonpesController;
use App\Http\Controllers\Admin_Kemenag\UpdateProfileController;
use App\Http\Controllers\Admin_Pesantren\ActivityController;
use App\Http\Controllers\Admin_Pesantren\DashboardController as U_DashboardController;
use App\Http\Controllers\Admin_Pesantren\FacilityController;
use App\Http\Controllers\Admin_Pesantren\ImagePonpesController;
use App\Http\Controllers\Admin_Pesantren\InstructorsController;
use App\Http\Controllers\Admin_Pesantren\LearningController;
use App\Http\Controllers\Admin_Pesantren\PonpesViewController as U_PonpesViewController;
use App\Http\Controllers\Admin_Pesantren\ProfileController as U_ProfileController;
use App\Http\Controllers\Admin_Pesantren\StudentCountController;
use App\Http\Controllers\Admin_Pesantren\UpdatePonpesController as U_UpdatePonpesController;
use App\Http\Controllers\Admin_Pesantren\UpdatePonpesEtcController;
use App\Http\Controllers\Admin_Pesantren\UpdateProfileController as U_UpdateProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pelapor\DataPonpesController as V_DataPonpesController;
use App\Http\Controllers\Pelapor\DataReportController;
use App\Http\Controllers\Pelapor\DataStatistikController as V_DataStatistikController;
use App\Http\Controllers\Pelapor\MapViewController as V_MapViewController;
use App\Http\Controllers\Pelapor\PonpesReportController;
use App\Http\Controllers\Pelapor\PonpesViewController as V_PonpesViewController;
use App\Http\Controllers\Pelapor\ProfileController as V_ProfileController;
use App\Http\Controllers\Pelapor\UpdateProfileController as V_UpdateProfileController;
use App\Http\Controllers\PengunjungController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

// // Auth::routes();
Auth::routes(['verify' => true]);
Route::redirect('/', '/pengunjung');
// Route::redirect('/home', '/pengunjung');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::redirect('/pengunjung', '/pengunjung/map_view');
Route::get('/pengunjung/map_view', [PengunjungController::class, 'index'])->name('pengunjung.map_view');
Route::get('/pengunjung/data_ponpes', [PengunjungController::class, 'dataPonpes'])->name('pengunjung.data_ponpes');
Route::get('/pengunjung/data_ponpes/search', [PengunjungController::class, 'ponpesSearch'])->name('pengunjung.ponpes_search');
Route::get('/pengunjung/ponpes_export_xlsx', [PengunjungController::class, 'exportXLSX']);
Route::get('/pengunjung/ponpes_export_csv', [PengunjungController::class, 'exportCSV']);

Route::get('/pengunjung/ponpes_view/{id}', [PengunjungController::class, 'ponpesView'])->name('pengunjung.ponpes_view');
Route::get('/pengunjung/data_statistik', [PengunjungController::class, 'ponpesStatistik'])->name('pengunjung.data_statistik');
Route::get('/pengunjung/ponpes_report', function () {
    return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman ini.');
});

Route::get('/pengunjung/panduan', function () {
    return view('pengunjung.tutorial_view');
});
// Route::get('/admin kemenag/data_ponpes', [DataPonpesController::class, 'index'])->name('pengunjung.data_ponpes');
// Route::get('/admin kemenag/ponpes_view/{id}', [PonpesViewController::class, 'view'])->name('pengunjung.ponpes_view');
// Route::get('/admin kemenag/ponpes/search', [DataPonpesController::class, 'search'])->name('pengunjung.ponpes_search');

// Rute untuk login dengan multi-role
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk admin
Route::middleware(['auth', 'role:admin kemenag'])->group(function () {

    Route::redirect('/home', '/admin');
    Route::redirect('/admin', '/admin kemenag/dashboard/');
    Route::get('/admin kemenag/profile/{id}', [ProfileController::class, 'index'])->name('admin_kemenag.profile');
    Route::get('/admin kemenag/edit_profile/{id}', [UpdateProfileController::class, 'index'])->name('admin_kemenag.edit_profile');
    Route::put('/admin kemenag/update_profile/{id}', [UpdateProfileController::class, 'update'])->name('admin_kemenag.update_profile');
    Route::put('/admin kemenag/update_password/{id}', [UpdateProfileController::class, 'update_password'])->name('admin_kemenag.update_password');
    Route::get('/admin kemenag/dashboard', [DashboardController::class, 'index'])->name('admin_kemenag.dashboard');
    Route::get('/admin kemenag/map_view', [MapViewController::class, 'index'])->name('admin_kemenag.map_view');
    Route::get('/admin kemenag/data_ponpes', [DataPonpesController::class, 'index'])->name('admin_kemenag.data_ponpes');
    Route::get('/admin kemenag/ponpes_view/{id}', [PonpesViewController::class, 'view'])->name('admin_kemenag.ponpes_view');
    Route::delete('/admin kemenag/ponpes/{id}', [PonpesViewController::class, 'destroy'])->name('admin_kemenag.ponpes_delete');
    Route::get('/admin kemenag/ponpes_export_xlsx', [DataPonpesController::class, 'exportXLSX']);
    Route::get('/admin kemenag/ponpes_export_csv', [DataPonpesController::class, 'exportCSV']);
    Route::get('/admin kemenag/data_ponpes/search', [DataPonpesController::class, 'search'])->name('admin_kemenag.ponpes_search');
    Route::get('/admin kemenag/create_ponpes', [CreatePonpesController::class, 'index']);
    Route::post('/admin kemenag/create_ponpes', [CreatePonpesController::class, 'create'])->name('admin_kemenag.create_ponpes');
    Route::get('/admin kemenag/data_admin_pesantren', [DataAdminPesantrenController::class, 'index'])->name('admin_kemenag.data_admin_pesantren');
    Route::post('/admin kemenag/account_admin_pesantren', [DataAdminPesantrenController::class, 'create'])->name('admin_kemenag.account_admin_pesantren_create');
    Route::delete('/admin kemenag/account_admin_pesantren/{id}', [DataAdminPesantrenController::class, 'destroy'])->name('admin_kemenag.account_admin_pesantren_delete');
    Route::put('/admin kemenag/account_admin_pesantren/{id}', [DataAdminPesantrenController::class, 'update'])->name('admin_kemenag.account_admin_pesantren_update');
    Route::get('/admin kemenag/account_admin_pesantren_export', [DataAdminPesantrenController::class, 'export']);

    Route::get('/admin kemenag/data_pelapor', [DataPelaporController::class, 'index'])->name('admin_kemenag.data_pelapor');
    Route::delete('/admin kemenag/account_pelapor/{id}', [DataPelaporController::class, 'destroy'])->name('admin_kemenag.account_pelapor_delete');
    Route::put('/admin kemenag/account_pelapor/{id}', [DataPelaporController::class, 'update'])->name('admin_kemenag.account_pelapor_update');
    Route::get('/admin kemenag/account_pelapor_export', [DataPelaporController::class, 'export']);

    Route::get('/admin kemenag/data_statistik', [DataStatistikController::class, 'index'])->name('admin_kemenag.data_statistik');
    Route::get('/admin kemenag/update_ponpes/{id}', [UpdatePonpesController::class, 'index'])->name('admin_kemenag.ponpes_edit');
    Route::put('/admin kemenag/update_ponpes/{id}', [UpdatePonpesController::class, 'update'])->name('admin_kemenag.ponpes_update');
    Route::get('/admin kemenag/data_report', [ReportController::class, 'index'])->name('admin_kemenag.data_report');
    Route::post('/admin kemenag/status/{id}', [ReportController::class, 'update_status'])->name('admin_kemenag.report_status_update');
    Route::get('/admin kemenag/report_export', [ReportController::class, 'export']);

    Route::get('/admin kemenag/category_report', [CategoryReportController::class, 'index'])->name('admin_kemenag.category_report');
    Route::post('/admin kemenag/category_report/create', [CategoryReportController::class, 'create'])->name('admin_kemenag.category_report_create');
    Route::put('/admin kemenag/category_report/update/{id}', [CategoryReportController::class, 'update'])->name('admin_kemenag.category_report_update');
    Route::delete('/admin kemenag/category_report/delete/{id}', [CategoryReportController::class, 'delete'])->name('admin_kemenag.category_report_delete');

    Route::get('/admin kemenag/panduan', function () {
        return view('admin_kemenag.tutorial_view');
    });
    // Route::get('/create_ponpes_2/{id}', [CreatePonpesController::class, 'ShowStepTwo'])->name('create_ponpes_2');
    // Route::post('/create_ponpes_langkah_2', [CreatePonpesController::class, 'stepTwo'])->name('create-ponpes-2');

});
// // Rute untuk updater
Route::middleware(['auth', 'role:admin pesantren'])->group(function () {
    Route::get('/admin pesantren/dashboard/{id}', [U_DashboardController::class, 'index'])->name('admin_pesantren.dashboard');
    Route::get('/admin pesantren/profile/{id}', [U_ProfileController::class, 'index'])->name('admin_pesantren.profile');
    Route::get('/admin pesantren/edit_profile/{id}', [U_UpdateProfileController::class, 'index'])->name('admin_pesantren.profile_edit');
    Route::put('/admin pesantren/update_profile/{id}', [U_UpdateProfileController::class, 'update'])->name('admin_pesantren.profile_update');
    Route::put('/admin pesantren/update_password/{id}', [U_UpdateProfileController::class, 'update_password'])->name('admin_pesantren.password_update');
    Route::get('/admin pesantren/ponpes_view/user_updater={id}', [U_PonpesViewController::class, 'view'])->name('admin_pesantren.ponpes_view');
    Route::get('/admin pesantren/update_ponpes/ponpes={id}', [U_UpdatePonpesController::class, 'index'])->name('admin_pesantren.ponpes_edit');
    Route::put('/admin pesantren/update_ponpes/ponpes={id}', [U_UpdatePonpesController::class, 'update'])->name('admin_pesantren.ponpes_update');
    Route::get('/admin pesantren/ponpes_update_etc/ponpes={id}', [UpdatePonpesEtcController::class, 'index'])->name('admin_pesantren.ponpes_edit_etc');

    Route::post('/admin pesantren/ponpes_update_etc/instructors/create', [InstructorsController::class, 'createInstructors'])->name('admin_pesantren.instructors_create');
    Route::delete('/admin pesantren/ponpes_update_etc/instructors/delete/{id}', [InstructorsController::class, 'destroyInstructors'])->name('admin_pesantren.instructors_delete');
    Route::put('/admin pesantren/ponpes_update_etc/instructors/update/{id}', [InstructorsController::class, 'updateInstructors'])->name('admin_pesantren.instructors_update');

    // Route::post('/admin pesantren/ponpes_update_etc/facility/create', [FacilityController::class, 'createFacility'])->name('admin_pesantren.facility_create');
    // Route::delete('/admin pesantren/ponpes_update_etc/facility/delete/{id}', [FacilityController::class, 'destroyFacility'])->name('admin_pesantren.facility_delete');
    Route::put('/admin pesantren/ponpes_update_etc/facility/update/{id}', [FacilityController::class, 'updateFacility'])->name('admin_pesantren.facility_update');

    Route::post('/admin pesantren/ponpes_update_etc/activities/create', [ActivityController::class, 'createActivities'])->name('admin_pesantren.activities_create');
    Route::delete('/admin pesantren/ponpes_update_etc/activities/delete/{id}', [ActivityController::class, 'destroyActivities'])->name('admin_pesantren.activities_delete');
    Route::put('/admin pesantren/ponpes_update_etc/activities/update/{id}', [ActivityController::class, 'updateActivities'])->name('admin_pesantren.activities_update');

    Route::post('/admin pesantren/ponpes_update_etc/learning/create', [LearningController::class, 'createLearning'])->name('admin_pesantren.learning_create');
    Route::delete('/admin pesantren/ponpes_update_etc/learning/delete/{id}', [LearningController::class, 'destroyLearning'])->name('admin_pesantren.learning_delete');
    Route::put('/admin pesantren/ponpes_update_etc/learning/update/{id}', [LearningController::class, 'updateLearning'])->name('admin_pesantren.learning_update');

    Route::post('/admin pesantren/ponpes_update_etc/studentcount/create', [StudentCountController::class, 'createStudentCount'])->name('admin_pesantren.studentcount_create');
    Route::delete('/admin pesantren/ponpes_update_etc/studentcount/delete/{id}', [StudentCountController::class, 'destroyStudentCount'])->name('admin_pesantren.studentcount_delete');
    Route::put('/admin pesantren/ponpes_update_etc/studentcount/update/{id}', [StudentCountController::class, 'updateStudentCount'])->name('admin_pesantren.studentcount_update');

    Route::get('/admin pesantren/ponpes_update_etc/image_ponpes/create/{id}', [ImagePonpesController::class, 'index'])->name('admin_pesantren.ponpes_image_create_view');
    Route::post('/admin pesantren/ponpes_update_etc/image_ponpes/create/jumbotron', [ImagePonpesController::class, 'create_jumbotron'])->name('admin_pesantren.ponpes_image_create_jumbotron');
    Route::post('/admin pesantren/ponpes_update_etc/image_ponpes/create/reguler', [ImagePonpesController::class, 'create_reguler'])->name('admin_pesantren.ponpes_image_create_reguler');
    Route::delete('/admin pesantren/ponpes_update_etc/image/delete/{id}', [ImagePonpesController::class, 'deleteImage'])->name('admin_pesantren.image_delete');

    Route::get('/admin pesantren/panduan', function () {
        return view('admin_pesantren.tutorial_view');
    });
});

// // Rute untuk viewer
Route::middleware(['auth', 'role:pelapor'])->group(function () {
    //Route::get('/pelapor/dashboard', [ViewerController::class, 'dashboard'])->name('pelapor.dashboard');
    Route::redirect('/viewer', '/pelapor/map_view');
    Route::get('/pelapor/map_view', [V_MapViewController::class, 'index'])->name('pelapor.map_view');
    Route::get('/pelapor/data_ponpes', [V_DataPonpesController::class, 'index'])->name('pelapor.data_ponpes');
    Route::get('/pelapor/data_ponpes/search', [V_DataPonpesController::class, 'ponpesSearch'])->name('pelapor.ponpes_search');
    Route::get('/pelapor/ponpes_export_xlsx', [V_DataPonpesController::class, 'exportXLSX']);
    Route::get('/pelapor/ponpes_export_csv', [V_DataPonpesController::class, 'exportCSV']);

    Route::get('/pelapor/ponpes_view/{id}', [V_PonpesViewController::class, 'index'])->name('pelapor.ponpes_view');
    Route::get('/pelapor/data_statistik', [V_DataStatistikController::class, 'index'])->name('pelapor.data_statistik');

    Route::get('/pelapor/profile/{id}', [V_ProfileController::class, 'index'])->name('pelapor.profile');
    Route::get('/pelapor/edit_profile/{id}', [V_UpdateProfileController::class, 'index'])->name('pelapor.profile_edit');
    Route::put('/pelapor/update_profile/{id}', [V_UpdateProfileController::class, 'update'])->name('pelapor.profile_update');
    Route::put('/pelapor/update_password/{id}', [V_UpdateProfileController::class, 'update_password'])->name('pelapor.password_update');

    Route::post('/pelapor/ponpes_view/report/{id}', [PonpesReportController::class, 'report'])->name('pelapor.ponpes_report');

    Route::get('/pelapor/data_report/{id}', [DataReportController::class, 'index'])->name('pelapor.data_report');
    Route::delete('/pelapor/data_report/delete/{id}', [DataReportController::class, 'delete'])->name('pelapor.report_delete');

    Route::get('/pelapor/panduan', function () {
        return view('pelapor.tutorial_view');
    });
});

// rute untuk register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// // Verifikasi email
// Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
//     ->middleware(['signed'])
//     ->name('verification.verify');

// // Tampilkan form untuk mengirim ulang email verifikasi
// Route::get('/email/verify', [VerificationController::class, 'show'])
//     ->middleware(['auth'])
//     ->name('verification.notice');

// // Kirim ulang email verifikasi
// Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
//     ->middleware(['auth', 'throttle:6,1'])
//     ->name('verification.resend');
