<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rute untuk login dengan multi-role
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Tambahkan rute lain untuk admin di sini
});

// Rute untuk updater
Route::middleware(['auth', 'role:updater'])->group(function () {
    Route::get('/updater/dashboard', [App\Http\Controllers\UpdaterController::class, 'dashboard'])->name('updater.dashboard');
    // Tambahkan rute lain untuk updater di sini
});

// Rute untuk viewer
Route::middleware(['auth', 'role:viewer'])->group(function () {
    Route::get('/viewer/dashboard', [App\Http\Controllers\ViewerController::class, 'dashboard'])->name('viewer.dashboard');
    // Tambahkan rute lain untuk viewer di sini
});
