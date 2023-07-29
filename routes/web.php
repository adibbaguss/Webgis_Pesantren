<?php

use App\Http\Controllers\Admin\CreatePonpesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataAccountController;
use App\Http\Controllers\Admin\DataPonpesController;
use App\Http\Controllers\Admin\DataStatistikController;
use App\Http\Controllers\Admin\MapViewController;
use App\Http\Controllers\Admin\PonpesViewController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UpdatePonpesController;
use App\Http\Controllers\Admin\UpdateProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Updater\DashboardController as U_DashboardController;
use App\Http\Controllers\Updater\PonpesImageCreateController;
use App\Http\Controllers\Updater\PonpesViewController as U_PonpesViewController;
use App\Http\Controllers\Updater\ProfileController as U_ProfileController;
use App\Http\Controllers\Updater\UpdatePonpesController as U_UpdatePonpesController;
use App\Http\Controllers\Updater\UpdatePonpesEtcController;
use App\Http\Controllers\Updater\UpdateProfileController as U_UpdateProfileController;
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

Route::redirect('/', '/login');
// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute untuk login dengan multi-role
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk reset password
Route::get('password/reset', [ResetPasswordController::class, 'reset_pass'])->name('reset');

// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/profile/{id}', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('/admin/edit_profile/{id}', [UpdateProfileController::class, 'index'])->name('admin.edit_profile');
    Route::put('/admin/update_profile/{id}', [UpdateProfileController::class, 'update'])->name('admin.update_profile');
    Route::put('/admin/update_password/{id}', [UpdateProfileController::class, 'update_password'])->name('admin.update_password');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/map_view', [MapViewController::class, 'index'])->name('admin.map_view');
    Route::get('/admin/data_ponpes', [DataPonpesController::class, 'index'])->name('admin.data_ponpes');
    Route::get('/admin/ponpes_view/{id}', [PonpesViewController::class, 'view'])->name('admin.ponpes_view');
    Route::delete('/admin/ponpes/{id}', [PonpesViewController::class, 'destroy'])->name('admin.ponpes_delete');
    Route::get('/admin/ponpes_export_xlsx', [DataPonpesController::class, 'exportXLSX']);
    Route::get('/admin/ponpes_export_csv', [DataPonpesController::class, 'exportCSV']);
    Route::get('/admin/ponpes/search', [DataPonpesController::class, 'search'])->name('admin.ponpes_search');
    Route::get('/admin/create_ponpes', [CreatePonpesController::class, 'index']);
    Route::post('/admin/create_ponpes', [CreatePonpesController::class, 'create'])->name('admin.create_ponpes');
    Route::get('/admin/data_account', [DataAccountController::class, 'index'])->name('admin.data_account');
    Route::delete('/admin/account/{id}', [DataAccountController::class, 'destroy'])->name('admin.account_delete');
    Route::put('/admin/account/{id}', [DataAccountController::class, 'update'])->name('admin.account_update');
    Route::get('/admin/account_export', [DataAccountController::class, 'export']);
    Route::post('/admin/account', [DataAccountController::class, 'create'])->name('admin.account_create');
    Route::get('/admin/data_statistik', [DataStatistikController::class, 'index'])->name('admin.data_statistik');
    Route::get('/admin/update_ponpes/{id}', [UpdatePonpesController::class, 'index'])->name('admin.ponpes_edit');
    Route::put('/admin/update_ponpes/{id}', [UpdatePonpesController::class, 'update'])->name('admin.ponpes_update');
    Route::get('/admin/data_report', [ReportController::class, 'index'])->name('admin.data_report');
    Route::put('/admin/status/{id}', [ReportController::class, 'update'])->name('admin.report_status_update');
    Route::get('/admin/report_export', [ReportController::class, 'export']);
    // Route::get('/create_ponpes_2/{id}', [CreatePonpesController::class, 'ShowStepTwo'])->name('create_ponpes_2');
    // Route::post('/create_ponpes_langkah_2', [CreatePonpesController::class, 'stepTwo'])->name('create-ponpes-2');

});
// // Rute untuk updater
Route::middleware(['auth', 'role:updater'])->group(function () {
    Route::get('/updater/dashboard/{id}', [U_DashboardController::class, 'index'])->name('updater.dashboard');
    Route::get('/updater/profile/{id}', [U_ProfileController::class, 'index'])->name('updater.profile');
    Route::get('/updater/edit_profile/{id}', [U_UpdateProfileController::class, 'index'])->name('updater.profile_edit');
    Route::put('/updater/update_profile/{id}', [U_UpdateProfileController::class, 'update'])->name('updater.profile_update');
    Route::put('/updater/update_password/{id}', [U_UpdateProfileController::class, 'update_password'])->name('updater.password_update');
    Route::get('/updater/ponpes_view/user_updater={id}', [U_PonpesViewController::class, 'view'])->name('updater.ponpes_view');
    Route::get('/updater/update_ponpes/ponpes={id}', [U_UpdatePonpesController::class, 'index'])->name('updater.ponpes_edit');
    Route::put('/updater/update_ponpes/ponpes={id}', [U_UpdatePonpesController::class, 'update'])->name('updater.ponpes_update');
    Route::get('/updater/ponpes_update_etc/ponpes={id}', [UpdatePonpesEtcController::class, 'index'])->name('updater.ponpes_edit_etc');

    Route::post('/updater/ponpes_update_etc/instructors/create', [UpdatePonpesEtcController::class, 'createInstructors'])->name('updater.instructors_create');
    Route::delete('/updater/ponpes_update_etc/instructors/delete/{id}', [UpdatePonpesEtcController::class, 'destroyInstructors'])->name('updater.instructors_delete');
    Route::put('/updater/ponpes_update_etc/instructors/update/{id}', [UpdatePonpesEtcController::class, 'updateInstructors'])->name('updater.instructors_update');

    Route::post('/updater/ponpes_update_etc/facility/create', [UpdatePonpesEtcController::class, 'createFacility'])->name('updater.facility_create');
    Route::delete('/updater/ponpes_update_etc/facility/delete/{id}', [UpdatePonpesEtcController::class, 'destroyFacility'])->name('updater.facility_delete');
    Route::put('/updater/ponpes_update_etc/facility/update/{id}', [UpdatePonpesEtcController::class, 'updateFacility'])->name('updater.facility_update');

    Route::post('/updater/ponpes_update_etc/activities/create', [UpdatePonpesEtcController::class, 'createActivities'])->name('updater.activities_create');
    Route::delete('/updater/ponpes_update_etc/activities/delete/{id}', [UpdatePonpesEtcController::class, 'destroyActivities'])->name('updater.activities_delete');
    Route::put('/updater/ponpes_update_etc/activities/update/{id}', [UpdatePonpesEtcController::class, 'updateActivities'])->name('updater.activities_update');

    Route::post('/updater/ponpes_update_etc/learning/create', [UpdatePonpesEtcController::class, 'createLearning'])->name('updater.learning_create');
    Route::delete('/updater/ponpes_update_etc/learning/delete/{id}', [UpdatePonpesEtcController::class, 'destroyLearning'])->name('updater.learning_delete');
    Route::put('/updater/ponpes_update_etc/learning/update/{id}', [UpdatePonpesEtcController::class, 'updateLearning'])->name('updater.learning_update');

    Route::post('/updater/ponpes_update_etc/studentcount/create', [UpdatePonpesEtcController::class, 'createStudentCount'])->name('updater.studentcount_create');
    Route::delete('/updater/ponpes_update_etc/studentcount/delete/{id}', [UpdatePonpesEtcController::class, 'destroyStudentCount'])->name('updater.studentcount_delete');
    Route::put('/updater/ponpes_update_etc/studentcount/update/{id}', [UpdatePonpesEtcController::class, 'updateStudentCount'])->name('updater.studentcount_update');

    Route::get('/updater/ponpes_update_etc/image_ponpes/create/{id}', [PonpesImageCreateController::class, 'index'])->name('updater.ponpes_image_create_view');
    Route::post('/updater/ponpes_update_etc/image_ponpes/create', [PonpesImageCreateController::class, 'create'])->name('updater.ponpes_image_create');
    //    Route::get('/updater/create_image_ponpes/ponpes={id}', [PonpesImageCreateController::class, 'index'])->name('updater.ponpes_image_show');
    // Route::post('/updater/create_image_ponpes/ponpes={id}', [PonpesImageCreateController::class, 'create'])->name('updater.ponpes_image_create');
    // Tambahkan rute lain untuk updater di sini
});

// // Rute untuk viewer
// Route::middleware(['auth', 'role:viewer'])->group(function () {
//     Route::get('/viewer/dashboard', [ViewerController::class, 'dashboard'])->name('viewer.dashboard');
//     // Tambahkan rute lain untuk viewer di sini
// });

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
