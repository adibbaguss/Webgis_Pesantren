<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CreatePonpesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAccountController;
use App\Http\Controllers\DataPonpesController;
use App\Http\Controllers\DataStatistikController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapViewController;
use App\Http\Controllers\PonpesViewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UpdatePonpesController;
use App\Http\Controllers\UpdateProfileController;
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

// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');
    Route::get('/edit_profile/{id}', [UpdateProfileController::class, 'index'])->name('edit_profile');
    Route::put('/update_profile/{id}', [UpdateProfileController::class, 'update'])->name('update_profile');
    Route::put('/update_password/{id}', [UpdateProfileController::class, 'update_password'])->name('update_password');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/map_view', [MapViewController::class, 'index'])->name('admin.map_view');
    Route::get('/admin/data_ponpes', [DataPonpesController::class, 'index'])->name('admin.data_ponpes');
    Route::get('/admin/ponpes_view/{id}', [PonpesViewController::class, 'view'])->name('admin.ponpes_view');
    Route::delete('/ponpes/{id}', [PonpesViewController::class, 'destroy'])->name('delete_ponpes');
    Route::get('/ponpes-export', [DataPonpesController::class, 'export']);
    Route::get('/ponpes-export-csv', [DataPonpesController::class, 'exportCSV']);
    Route::get('/search', [DataPonpesController::class, 'search'])->name('search');
    Route::get('/create_ponpes', [CreatePonpesController::class, 'index']);
    Route::post('/create_ponpes', [CreatePonpesController::class, 'create'])->name('create-ponpes');
    Route::get('/admin/data_account', [DataAccountController::class, 'index'])->name('admin.data_account');
    Route::delete('account/{id}', [DataAccountController::class, 'destroy'])->name('delete_account');
    Route::put('account/{id}', [DataAccountController::class, 'update'])->name('update_account');
    Route::get('/account_export', [DataAccountController::class, 'export']);
    Route::post('/account', [DataAccountController::class, 'create'])->name('create_account');
    Route::get('/admin/data_statistik', [DataStatistikController::class, 'index'])->name('admin.data_statistik');
    Route::get('/update_ponpes/{id}', [UpdatePonpesController::class, 'index'])->name('update_ponpes.edit');
    Route::put('/update_ponpes/{id}', [UpdatePonpesController::class, 'update'])->name('update_ponpes.update');
    Route::get('/admin/data_report', [ReportController::class, 'index'])->name('admin.data_report');
    Route::put('status/{id}', [ReportController::class, 'update'])->name('update_status_report');
    Route::get('/report-export', [ReportController::class, 'export']);
    // Route::get('/create_ponpes_2/{id}', [CreatePonpesController::class, 'ShowStepTwo'])->name('create_ponpes_2');
    // Route::post('/create_ponpes_langkah_2', [CreatePonpesController::class, 'stepTwo'])->name('create-ponpes-2');

});
// // Rute untuk updater
// Route::middleware(['auth', 'role:updater'])->group(function () {
//     Route::get('/updater/dashboard', [UpdaterController::class, 'dashboard'])->name('updater.dashboard');
//     // Tambahkan rute lain untuk updater di sini
// });

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
