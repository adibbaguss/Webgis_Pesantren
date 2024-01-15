<?php

use App\Http\Controllers\Admin_Kemenag\CategoryReportController;
use App\Http\Controllers\Admin_Kemenag\CreatePonpesController;
use App\Http\Controllers\Admin_Kemenag\DashboardController;
use App\Http\Controllers\Admin_Kemenag\DataAdminPesantrenController;
use App\Http\Controllers\Admin_Kemenag\DataPelaporController;
use App\Http\Controllers\Admin_Kemenag\DataPonpesController;
use App\Http\Controllers\Admin_Kemenag\DataSdmController;
use App\Http\Controllers\Admin_Kemenag\DataStatistikController;
use App\Http\Controllers\Admin_Kemenag\Madin\CategoryReportController as AK_Madin_CategoryReportController;
use App\Http\Controllers\Admin_Kemenag\Madin\CreateMadinController;
use App\Http\Controllers\Admin_Kemenag\Madin\DataAdminMadinController;
use App\Http\Controllers\Admin_Kemenag\Madin\DataMadinController;
use App\Http\Controllers\Admin_Kemenag\Madin\DataSdmController as AK_Madin_DataSdmController;
use App\Http\Controllers\Admin_Kemenag\Madin\MadinViewController;
use App\Http\Controllers\Admin_Kemenag\Madin\MapFacilityController as AK_Madin_MapFacilityController;
use App\Http\Controllers\Admin_Kemenag\Madin\MapViewController as AK_Madin_MapviewController;
use App\Http\Controllers\Admin_Kemenag\Madin\ReportController as AK_Madin_ReportController;
use App\Http\Controllers\Admin_Kemenag\Madin\UpdateMadinController;
use App\Http\Controllers\Admin_Kemenag\MapCategoryController;
use App\Http\Controllers\Admin_Kemenag\MapsFacilityController;
use App\Http\Controllers\Admin_Kemenag\MapsSchoolsController;
use App\Http\Controllers\Admin_Kemenag\MapTakhasusController;
use App\Http\Controllers\Admin_Kemenag\MapViewController;
use App\Http\Controllers\Admin_Kemenag\PonpesViewController;
use App\Http\Controllers\Admin_Kemenag\ProfileController;
use App\Http\Controllers\Admin_Kemenag\ReportController;
use App\Http\Controllers\Admin_Kemenag\UpdatePonpesController;
use App\Http\Controllers\Admin_Kemenag\UpdateProfileController;
use App\Http\Controllers\Admin_Madin\ActivityController as Madin_ActivityController;
use App\Http\Controllers\Admin_Madin\DashboardController as Admin_madin_DashboardController;
use App\Http\Controllers\Admin_Madin\FacilityController as Madin_FacilityController;
use App\Http\Controllers\Admin_Madin\ImageMadinController;
use App\Http\Controllers\Admin_Madin\InstructorsController as Madin_InstructorsController;
use App\Http\Controllers\Admin_Madin\LearningController as Madin_LearningController;
use App\Http\Controllers\Admin_Madin\MadinViewController as Admin_madin_MadinViewController;
use App\Http\Controllers\Admin_Madin\ProfileController as Admin_madin_ProfileController;
use App\Http\Controllers\Admin_Madin\StudentCountController as Madin_StudentCountController;
use App\Http\Controllers\Admin_Madin\UpdateMadinController as Admin_madin_UpdateMadinController;
use App\Http\Controllers\Admin_Madin\UpdateMadinEtcController;
use App\Http\Controllers\Admin_Madin\UpdateProfileController as Admin_madin_UpdateProfileController;
use App\Http\Controllers\Admin_Pesantren\ActivityController;
use App\Http\Controllers\Admin_Pesantren\DashboardController as Admin_Pesantren_DashboardController;
use App\Http\Controllers\Admin_Pesantren\FacilityController;
use App\Http\Controllers\Admin_Pesantren\ImagePonpesController;
use App\Http\Controllers\Admin_Pesantren\InstructorsController;
use App\Http\Controllers\Admin_Pesantren\LearningController;
use App\Http\Controllers\Admin_Pesantren\PonpesViewController as Admin_Pesantren_PonpesViewController;
use App\Http\Controllers\Admin_Pesantren\ProfileController as Admin_Pesantren_ProfileController;
use App\Http\Controllers\Admin_Pesantren\ProgramTakhasusController;
use App\Http\Controllers\Admin_Pesantren\SchoolController;
use App\Http\Controllers\Admin_Pesantren\StudentCountController;
use App\Http\Controllers\Admin_Pesantren\UpdatePonpesController as Admin_Pesantren_UpdatePonpesController;
use App\Http\Controllers\Admin_Pesantren\UpdatePonpesEtcController;
use App\Http\Controllers\Admin_Pesantren\UpdateProfileController as Admin_Pesantren_UpdateProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BelumBerelasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pelapor\DataPonpesController as Pelapor_DataPonpesController;
use App\Http\Controllers\Pelapor\DataReportController;
use App\Http\Controllers\Pelapor\DataStatistikController as Pelapor_DataStatistikController;
use App\Http\Controllers\Pelapor\Madin\DataMadinController as Pelapor_DataMadinController;
use App\Http\Controllers\Pelapor\Madin\DataReportController as Pelapor_Madin_DataReportController;
use App\Http\Controllers\Pelapor\Madin\MadinReportController;
use App\Http\Controllers\Pelapor\Madin\MadinViewController as Pelapor_MadinViewController;
use App\Http\Controllers\Pelapor\Madin\MapViewController as Pelapor_Madin_MapViewController;
use App\Http\Controllers\Pelapor\MapCategoryController as pelapor_MapCategoryController;
use App\Http\Controllers\Pelapor\MapFacilityController as Pelapor_MapFacilityController;
use App\Http\Controllers\Pelapor\MapsSchoolsController as Pelapor_MapsSchoolsController;
use App\Http\Controllers\Pelapor\MapTakhasusController as Pelapor_MapTakhasusController;
use App\Http\Controllers\Pelapor\MapViewController as Pelapor_MapViewController;
use App\Http\Controllers\Pelapor\PonpesReportController;
use App\Http\Controllers\Pelapor\PonpesViewController as Pelapor_PonpesViewController;
use App\Http\Controllers\Pelapor\ProfileController as Pelapor_ProfileController;
use App\Http\Controllers\Pelapor\UpdateProfileController as Pelapor_UpdateProfileController;
use App\Http\Controllers\Pengunjung\DataPonpesController as Pengunjung_DataPonpesController;
use App\Http\Controllers\Pengunjung\DataStatistikController as Pengunjung_DataStatistikController;
use App\Http\Controllers\Pengunjung\Madin\DataMadinController as Pengunjung_DataMadinController;
use App\Http\Controllers\Pengunjung\Madin\MadinViewController as Pengunjung_MadinViewController;
use App\Http\Controllers\Pengunjung\Madin\MapFacilityController as Pelapor_Madin_MapFacilityController;
use App\Http\Controllers\Pengunjung\Madin\MapFacilityController as Pengunjung_Madin_MapFaciltiyController;
use App\Http\Controllers\Pengunjung\Madin\MapViewController as Pengunjung_Madin_MapViewController;
use App\Http\Controllers\Pengunjung\MapCategoryController as Pengunjung_MapCategoryController;
use App\Http\Controllers\Pengunjung\MapFacilityController;
use App\Http\Controllers\Pengunjung\MapsSchoolsController as Pengunjung_MapsSchoolsController;
use App\Http\Controllers\Pengunjung\MapTakhasusController as Pengunjung_MapTakhasusController;
use App\Http\Controllers\Pengunjung\MapViewController as Pengunjung_MapViewController;
use App\Http\Controllers\Pengunjung\PonpesViewController as Pengunjung_PonpesViewController;
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
Route::get('/pengunjung/map_view', [Pengunjung_MapViewController::class, 'index'])->name('pengunjung.map_view');
Route::get('/pengujung/map_view/export_xlsx', [Pengunjung_MapViewController::class, 'exportXLSX']);
Route::get('/pengunjung/map_view/ponpes_export_csv', [Pengunjung_MapViewController::class, 'exportCSV']);

Route::get('/pengunjung/map_category', [Pengunjung_MapCategoryController::class, 'index'])->name('pengunjung.map_category');

Route::get('/pengunjung/data_ponpes', [Pengunjung_DataPonpesController::class, 'index'])->name('pengunjung.data_ponpes');
Route::get('/pengunjung/data_ponpes/search', [Pengunjung_DataPonpesController::class, 'ponpesSearch'])->name('pengunjung.ponpes_search');
Route::get('/pengunjung/ponpes_export_xlsx', [Pengunjung_DataPonpesController::class, 'exportXLSX']);
Route::get('/pengunjung/ponpes_export_csv', [Pengunjung_DataPonpesController::class, 'exportCSV']);

Route::get('/pengunjung/ponpes_view/{id}', [Pengunjung_PonpesViewController::class, 'ponpesView'])->name('pengunjung.ponpes_view');

Route::get('/pengunjung/data_statistik', [Pengunjung_DataStatistikController::class, 'index'])->name('pengunjung.data_statistik');

Route::get('/pengunjung/maps_schools', [Pengunjung_MapsSchoolsController::class, 'index'])->name('pengunjung.maps_schools');
Route::get('/pengunjung/maps_schools/search', [Pengunjung_MapsSchoolsController::class, 'search'])->name('pengunjung.search_schools');
Route::get('/pengunjung/sekolah_ponpes_export_xlsx', [Pengunjung_MapsSchoolsController::class, 'exportXLSX']);
Route::get('/pengunjung/sekolah_ponpes_export_csv', [Pengunjung_MapsSchoolsController::class, 'exportCSV']);

Route::get('/pengunjung/map_takhasus', [Pengunjung_MapTakhasusController::class, 'index'])->name('pengunjung.map_takhasus');

Route::get('/pengunjung/maps_facility', [MapFacilityController::class, 'index'])->name('pengunjung.maps_facility');
Route::get('/pengunjung/maps_facility/search', [MapFacilityController::class, 'search'])->name('pengunjung.search_facility');
Route::get('/pengunjung/fasilitas_ponpes_export_xlsx', [MapFacilityController::class, 'exportXLSX']);
Route::get('/pengunjung/fasilitas_ponpes_export_csv', [MapFacilityController::class, 'exportCSV']);

Route::get('/pengunjung/ponpes_report', function () {
    return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman ini.');
});

// madin
Route::get('/pengunjung/madin/map_view', [Pengunjung_Madin_MapViewController::class, 'index'])->name('pengunjung.madin.map_view');
Route::get('/pengunjung/madin/map_view/export_xlsx', [Pengunjung_Madin_MapViewController::class, 'exportXLSX']);
Route::get('/pengunjung/madin/map_view/export_csv', [Pengunjung_Madin_MapViewController::class, 'exportCSV']);

Route::get('/pengunjung/madin/map_facility', [Pengunjung_Madin_MapFaciltiyController::class, 'index'])->name('pengunjung.madin.map_facility');
Route::get('/pengunjung/madin/map_facility/search', [Pengunjung_Madin_MapFaciltiyController::class, 'search'])->name('pengunjung.madin.search_facility');

Route::get('/pengunjung/madin/madin_view/{id}', [Pengunjung_MadinViewController::class, 'index'])->name('pengunjung.madin.madin_view');

Route::get('/pengunjung/data_madin', [Pengunjung_DataMadinController::class, 'index'])->name('pengunjung.data_madin');
Route::get('/pengunjung/madin_export_xlsx', [Pengunjung_DataMadinController::class, 'exportXLSX']);
Route::get('/pengunjung/madin_export_csv', [Pengunjung_DataMadinController::class, 'exportCSV']);
Route::get('/pengunjung/data_madin/search', [Pengunjung_DataMadinController::class, 'search'])->name('pengunjung.madin_search');

Route::get('/pengunjung/madin/madin_report', function () {
    return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman ini.');
});
// percobaan maps
// Route::get('/pengunjung/maps_facility', [MapsFacilityController::class, 'index'])->name('maps.facility');
// Route::get('/pengunjung/maps_facility/search', [MapsFacilityController::class, 'search'])->name('search.facility');

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

    Route::redirect('/home', '/admin kemenag');
    Route::redirect('/admin kemenag', '/admin kemenag/dashboard/');
    Route::get('/admin kemenag/profile/{id}', [ProfileController::class, 'index'])->name('admin_kemenag.profile');
    Route::get('/admin kemenag/edit_profile/{id}', [UpdateProfileController::class, 'index'])->name('admin_kemenag.edit_profile');
    Route::put('/admin kemenag/update_profile/{id}', [UpdateProfileController::class, 'update'])->name('admin_kemenag.update_profile');
    Route::put('/admin kemenag/update_password/{id}', [UpdateProfileController::class, 'update_password'])->name('admin_kemenag.update_password');
    Route::get('/admin kemenag/dashboard', [DashboardController::class, 'index'])->name('admin_kemenag.dashboard');

    Route::get('/admin kemenag/map_view', [MapViewController::class, 'index'])->name('admin_kemenag.map_view');
    Route::get('/admin kemenag/map_view/export_xlsx', [MapViewController::class, 'exportXLSX']);
    Route::get('/admin kemenag/map_view/export_csv', [MapViewController::class, 'exportCSV']);

    Route::get('/admin kemenag/map_category', [MapCategoryController::class, 'index'])->name('admin_kemenag.map_category');

    Route::get('/admin kemenag/map_takhasus', [MapTakhasusController::class, 'index'])->name('admin_kemenag.map_takhasus');

    Route::get('/admin kemenag/maps_schools', [MapsSchoolsController::class, 'index'])->name('admin_kemenag.maps_schools');
    Route::get('/admin kemenag/maps_schools/search', [MapsSchoolsController::class, 'search'])->name('admin_kemenag.search_schools');
    Route::get('/admin kemenag/sekolah_ponpes_export_xlsx', [MapsSchoolsController::class, 'exportXLSX']);
    Route::get('/admin kemenag/sekolah_ponpes_export_csv', [MapsSchoolsController::class, 'exportCSV']);

    Route::get('/admin kemenag/ponpes_view/{id}', [PonpesViewController::class, 'view'])->name('admin_kemenag.ponpes_view');
    Route::delete('/admin kemenag/ponpes/{id}', [PonpesViewController::class, 'destroy'])->name('admin_kemenag.ponpes_delete');

    Route::get('/admin kemenag/data_ponpes', [DataPonpesController::class, 'index'])->name('admin_kemenag.data_ponpes');
    Route::get('/admin kemenag/ponpes_export_xlsx', [DataPonpesController::class, 'exportXLSX']);
    Route::get('/admin kemenag/ponpes_export_csv', [DataPonpesController::class, 'exportCSV']);
    Route::get('/admin kemenag/data_ponpes/search', [DataPonpesController::class, 'search'])->name('admin_kemenag.ponpes_search');
    Route::get('/admin kemenag/create_ponpes', [CreatePonpesController::class, 'index']);
    Route::post('/admin kemenag/create_ponpes', [CreatePonpesController::class, 'create'])->name('admin_kemenag.create_ponpes');

    Route::get('/admin kemenag/ponpes/data_sdm', [DataSdmController::class, 'index'])->name('admin_kemenag.data_sdm_ponpes');
    Route::get('/admin kemenag/sdm_ponpes_export_xlsx', [DataSdmController::class, 'exportXLSX']);
    Route::get('/admin kemenag/sdm_ponpes_export_csv', [DataSdmController::class, 'exportCSV']);

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

    Route::get('/admin kemenag/maps_facility', [MapsFacilityController::class, 'index'])->name('admin_kemenag.maps_facility');
    Route::get('/admin kemenag/maps_facility/search', [MapsFacilityController::class, 'search'])->name('admin_kemenag.search_facility');
    Route::get('/admin kemenag/fasilitas_ponpes_export_xlsx', [MapsFacilityController::class, 'exportXLSX']);
    Route::get('/admin kemenag/fasilitas_ponpes_export_csv', [MapsFacilityController::class, 'exportCSV']);

    // madin and tpq

    Route::get('/admin kemenag/madin/map_view', [AK_Madin_MapviewController::class, 'index'])->name('admin_kemenag.madin.map_view');
    Route::get('/admin kemenag/madin/map_view/export_xlsx', [AK_Madin_MapviewController::class, 'exportXLSX']);
    Route::get('/admin kemenag/madin/map_view/export_csv', [AK_Madin_MapviewController::class, 'exportCSV']);

    Route::get('/admin kemenag/madin/maps_facility', [AK_Madin_MapFacilityController::class, 'index'])->name('admin_kemenag.madin.maps_facility');
    Route::get('/admin kemenag/madin/maps_facility/search', [AK_Madin_MapFacilityController::class, 'search'])->name('admin_kemenag.madin.search_facility');
    Route::get('/admin kemenag/madin/fasilitas/export_xlsx', [AK_Madin_MapFacilityController::class, 'exportXLSX']);
    Route::get('/admin kemenag/madin/fasilitas/export_csv', [AK_Madin_MapFacilityController::class, 'exportCSV']);

    Route::get('/admin kemenag/madin/madin_view/{id}', [MadinViewController::class, 'index'])->name('admin_kemenag.madin.madin_view');
    Route::delete('/admin kemenag/madin/delete/{id}', [MadinViewController::class, 'destroy'])->name('admin_kemenag.madin_delete');

    Route::get('/admin kemenag/data_madin', [DataMadinController::class, 'index'])->name('admin_kemenag.data_madin');
    Route::get('/admin kemenag/madin_export_xlsx', [DataMadinController::class, 'exportXLSX']);
    Route::get('/admin kemenag/madin_export_csv', [DataMadinController::class, 'exportCSV']);
    Route::get('/admin kemenag/data_madin/search', [DataMadinController::class, 'search'])->name('admin_kemenag.madin_search');

    Route::get('/admin kemenag/create_madin', [CreateMadinController::class, 'index']);
    Route::post('/admin kemenag/create_madin', [CreateMadinController::class, 'create'])->name('admin_kemenag.create_madin');

    Route::get('/admin kemenag/update_madin/{id}', [UpdateMadinController::class, 'index'])->name('admin_kemenag.madin_edit');
    Route::put('/admin kemenag/update_madin/{id}', [UpdateMadinController::class, 'update'])->name('admin_kemenag.madin_update');

    Route::get('/admin kemenag/madin/data_sdm', [AK_Madin_DataSdmController::class, 'index'])->name('admin_kemenag.data_sdm_madin');
    Route::get('/admin kemenag/sdm_madin_export_xlsx', [AK_Madin_DataSdmController::class, 'exportXLSX']);
    Route::get('/admin kemenag/sdm_madin_export_csv', [AK_Madin_DataSdmController::class, 'exportCSV']);

    Route::get('/admin kemenag/madin/data_admin_madin', [DataAdminMadinController::class, 'index'])->name('admin_kemenag.data_admin_madin');
    Route::post('/admin kemenag/madin/account_admin_madin', [DataAdminMadinController::class, 'create'])->name('admin_kemenag.account_admin_madin_create');
    Route::delete('/admin kemenag/madin/account_admin_madin/{id}', [DataAdminMadinController::class, 'destroy'])->name('admin_kemenag.account_admin_madin_delete');
    Route::put('/admin kemenag/madin/account_admin_madin/{id}', [DataAdminMadinController::class, 'update'])->name('admin_kemenag.account_admin_madin_update');
    Route::get('/admin kemenag/madin/account_admin_madin_export', [DataAdminMadinController::class, 'export']);

    Route::get('/admin kemenag/madin/data_report', [AK_Madin_ReportController::class, 'index'])->name('admin_kemenag.madin.data_report');
    Route::post('/admin kemenag/madin/status/{id}', [AK_Madin_ReportController::class, 'update_status'])->name('admin_kemenag.madin.report_status_update');
    Route::get('/admin kemenag/madin/report_export', [AK_Madin_ReportController::class, 'export']);

    Route::get('/admin kemenag/madin/category_report', [AK_Madin_CategoryReportController::class, 'index'])->name('admin_kemenag.madin.category_report');
    Route::post('/admin kemenag/madin/category_report/create', [AK_Madin_CategoryReportController::class, 'create'])->name('admin_kemenag.madin.category_report_create');
    Route::put('/admin kemenag/madin/category_report/update/{id}', [AK_Madin_CategoryReportController::class, 'update'])->name('admin_kemenag.madin.category_report_update');
    Route::delete('/admin kemenag/madin/category_report/delete/{id}', [AK_Madin_CategoryReportController::class, 'delete'])->name('admin_kemenag.madin.category_report_delete');

    Route::get('/admin kemenag/panduan', function () {
        return view('admin_kemenag.tutorial_view');
    });
    // Route::get('/create_ponpes_2/{id}', [CreatePonpesController::class, 'ShowStepTwo'])->name('create_ponpes_2');
    // Route::post('/create_ponpes_langkah_2', [CreatePonpesController::class, 'stepTwo'])->name('create-ponpes-2');

});

// // Rute untuk admin_pesantren
Route::middleware(['auth', 'role:admin pesantren'])->group(function () {
    Route::get('/admin pesantren/dashboard/{id}', [Admin_Pesantren_DashboardController::class, 'index'])->name('admin_pesantren.dashboard');
    Route::get('/admin pesantren/profile/{id}', [Admin_Pesantren_ProfileController::class, 'index'])->name('admin_pesantren.profile');
    Route::get('/admin pesantren/edit_profile/{id}', [Admin_Pesantren_UpdateProfileController::class, 'index'])->name('admin_pesantren.profile_edit');
    Route::put('/admin pesantren/update_profile/{id}', [Admin_Pesantren_UpdateProfileController::class, 'update'])->name('admin_pesantren.profile_update');
    Route::put('/admin pesantren/update_password/{id}', [Admin_Pesantren_UpdateProfileController::class, 'update_password'])->name('admin_pesantren.password_update');
    Route::get('/admin pesantren/ponpes_view/user_admin_pesantren={id}', [Admin_Pesantren_PonpesViewController::class, 'view'])->name('admin_pesantren.ponpes_view');

    Route::get('/admin pesantren/update_ponpes/ponpes={id}', [Admin_Pesantren_UpdatePonpesController::class, 'index'])->name('admin_pesantren.ponpes_edit');
    Route::put('/admin pesantren/update_ponpes/ponpes={id}', [Admin_Pesantren_UpdatePonpesController::class, 'update'])->name('admin_pesantren.ponpes_update');
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

    Route::post('/admin pesantren/ponpes_update_etc/school/create', [SchoolController::class, 'createSchool'])->name('admin_pesantren.school_create');
    Route::put('/admin pesantren/ponpes_update_etc/school/update/{id}', [SchoolController::class, 'updateSchool'])->name('admin_pesantren.school_update');
    Route::delete('/admin pesantren/ponpes_update_etc/school/delete/{id}', [SchoolController::class, 'deleteSchool'])->name('admin_pesantren.school_delete');

    Route::post('/admin pesantren/ponpes_update_etc/program_takhasus/create', [ProgramTakhasusController::class, 'createTakhasus'])->name('admin_pesantren.program_takhasus_create');
    Route::delete('/admin pesantren/ponpes_update_etc/program_takhasus/delete/{id}', [ProgramTakhasusController::class, 'destroyTakhasus'])->name('admin_pesantren.program_takhasus_delete');
    Route::put('/admin pesantren/ponpes_update_etc/program_takhasus/update/{id}', [ProgramTakhasusController::class, 'updateTakhasus'])->name('admin_pesantren.program_takhasus_update');

    Route::get('/admin pesantren/panduan', function () {
        return view('admin_pesantren.tutorial_view');
    });
});

// // Rute untuk admin_madin
Route::middleware(['auth', 'role:admin madin'])->group(function () {
    Route::get('/admin madin/dashboard/{id}', [Admin_madin_DashboardController::class, 'index'])->name('admin_madin.dashboard');
    Route::get('/admin madin/profile/{id}', [Admin_madin_ProfileController::class, 'index'])->name('admin_madin.profile');
    Route::get('/admin madin/edit_profile/{id}', [Admin_madin_UpdateProfileController::class, 'index'])->name('admin_madin.profile_edit');
    Route::put('/admin madin/update_profile/{id}', [Admin_madin_UpdateProfileController::class, 'update'])->name('admin_madin.profile_update');
    Route::put('/admin madin/update_password/{id}', [Admin_madin_UpdateProfileController::class, 'update_password'])->name('admin_madin.password_update');

    Route::get('/admin madin/madin_view/user_admin_madin={id}', [Admin_madin_MadinViewController::class, 'view'])->name('admin_madin.madin_view');

    Route::get('/admin madin/update_madin/madin={id}', [Admin_madin_UpdateMadinController::class, 'index'])->name('admin_madin.madin_edit');
    Route::put('/admin madin/update_madin/madin={id}', [Admin_madin_UpdateMadinController::class, 'update'])->name('admin_madin.madin_update');

    Route::get('/admin madin/madin_update_etc/madin={id}', [UpdateMadinEtcController::class, 'index'])->name('admin_madin.madin_edit_etc');

    Route::post('/admin madin/madin_update_etc/instructors/create', [Madin_InstructorsController::class, 'createInstructors'])->name('admin_madin.instructors_create');
    Route::delete('/admin madin/madin_update_etc/instructors/delete/{id}', [Madin_InstructorsController::class, 'destroyInstructors'])->name('admin_madin.instructors_delete');
    Route::put('/admin madin/madin_update_etc/instructors/update/{id}', [Madin_InstructorsController::class, 'updateInstructors'])->name('admin_madin.instructors_update');

    Route::post('/admin madin/madin_update_etc/facility/create', [Madin_FacilityController::class, 'createFacility'])->name('admin_madin.facility_create');
    Route::delete('/admin madin/madin_update_etc/facility/delete/{id}', [Madin_FacilityController::class, 'destroyFacility'])->name('admin_madin.facility_delete');
    Route::put('/admin madin/madin_update_etc/facility/update/{id}', [Madin_FacilityController::class, 'updateFacility'])->name('admin_madin.facility_update');

    Route::post('/admin madin/madin_update_etc/activities/create', [Madin_ActivityController::class, 'createActivities'])->name('admin_madin.activities_create');
    Route::delete('/admin madin/madin_update_etc/activities/delete/{id}', [Madin_ActivityController::class, 'destroyActivities'])->name('admin_madin.activities_delete');
    Route::put('/admin madin/madin_update_etc/activities/update/{id}', [Madin_ActivityController::class, 'updateActivities'])->name('admin_madin.activities_update');

    Route::post('/admin madin/madin_update_etc/learning/create', [Madin_LearningController::class, 'createLearning'])->name('admin_madin.learning_create');
    Route::delete('/admin madin/madin_update_etc/learning/delete/{id}', [Madin_LearningController::class, 'destroyLearning'])->name('admin_madin.learning_delete');
    Route::put('/admin madin/madin_update_etc/learning/update/{id}', [Madin_LearningController::class, 'updateLearning'])->name('admin_madin.learning_update');

    Route::post('/admin madin/madin_update_etc/studentcount/create', [Madin_StudentCountController::class, 'createStudentCount'])->name('admin_madin.studentcount_create');
    Route::delete('/admin madin/madin_update_etc/studentcount/delete/{id}', [Madin_StudentCountController::class, 'destroyStudentCount'])->name('admin_madin.studentcount_delete');
    Route::put('/admin madin/madin_update_etc/studentcount/update/{id}', [Madin_StudentCountController::class, 'updateStudentCount'])->name('admin_madin.studentcount_update');

    Route::get('/admin madin/madin_update_etc/image_madin/create/{id}', [ImageMadinController::class, 'index'])->name('admin_madin.madin_image_create_view');
    Route::post('/admin madin/madin_update_etc/image_madin/create/jumbotron', [ImageMadinController::class, 'create_jumbotron'])->name('admin_madin.madin_image_create_jumbotron');
    Route::post('/admin madin/madin_update_etc/image_madin/create/reguler', [ImageMadinController::class, 'create_reguler'])->name('admin_madin.madin_image_create_reguler');
    Route::delete('/admin madin/madin_update_etc/image/delete/{id}', [ImageMadinController::class, 'deleteImage'])->name('admin_madin.image_delete');

    Route::get('/admin madin/panduan', function () {
        return view('admin_madin.tutorial_view');
    });
});

// // Rute untuk pelapor
Route::middleware(['auth', 'role:pelapor'])->group(function () {
    //Route::get('/pelapor/dashboard', [pelaporController::class, 'dashboard'])->name('pelapor.dashboard');
    Route::redirect('/pelapor', '/pelapor/map_view');

    Route::get('/pelapor/map_view', [pelapor_MapViewController::class, 'index'])->name('pelapor.map_view');
    Route::get('/pelapor/map_view/export_xlsx', [pelapor_MapViewController::class, 'exportXLSX']);
    Route::get('/pelapor/map_view/export_csv', [pelapor_MapViewController::class, 'exportCSV']);

    Route::get('/pelapor/map_category', [pelapor_MapCategoryController::class, 'index'])->name('pelapor.map_category');

    Route::get('/pelapor/maps_schools', [Pelapor_MapsSchoolsController::class, 'index'])->name('pelapor.maps_schools');
    Route::get('/pelapor/maps_schools/search', [Pelapor_MapsSchoolsController::class, 'search'])->name('pelapor.search_schools');
    Route::get('/pelapor/sekolah_ponpes_export_xlsx', [Pelapor_MapsSchoolsController::class, 'exportXLSX']);
    Route::get('/pelapor/sekolah_ponpes_export_csv', [Pelapor_MapsSchoolsController::class, 'exportCSV']);

    Route::get('/pelapor/map_takhasus', [Pelapor_MapTakhasusController::class, 'index'])->name('pelapor.map_takhasus');

    Route::get('/pelapor/maps_facility', [Pelapor_MapFacilityController::class, 'index'])->name('pelapor.maps_facility');
    Route::get('/pelapor/maps_facility/search', [Pelapor_MapFacilityController::class, 'search'])->name('pelapor.search_facility');
    Route::get('/pelapor/fasilitas_ponpes_export_xlsx', [Pelapor_MapFacilityController::class, 'exportXLSX']);
    Route::get('/pelapor/fasilitas_ponpes_export_csv', [Pelapor_MapFacilityController::class, 'exportCSV']);

    Route::get('/pelapor/data_ponpes', [Pelapor_DataPonpesController::class, 'index'])->name('pelapor.data_ponpes');
    Route::get('/pelapor/data_ponpes/search', [Pelapor_DataPonpesController::class, 'ponpesSearch'])->name('pelapor.ponpes_search');
    Route::get('/pelapor/ponpes_export_xlsx', [Pelapor_DataPonpesController::class, 'exportXLSX']);
    Route::get('/pelapor/ponpes_export_csv', [Pelapor_DataPonpesController::class, 'exportCSV']);

    Route::get('/pelapor/ponpes_view/{id}', [Pelapor_PonpesViewController::class, 'index'])->name('pelapor.ponpes_view');
    Route::get('/pelapor/data_statistik', [Pelapor_DataStatistikController::class, 'index'])->name('pelapor.data_statistik');

    Route::get('/pelapor/profile/{id}', [Pelapor_ProfileController::class, 'index'])->name('pelapor.profile');
    Route::get('/pelapor/edit_profile/{id}', [Pelapor_UpdateProfileController::class, 'index'])->name('pelapor.profile_edit');
    Route::put('/pelapor/update_profile/{id}', [Pelapor_UpdateProfileController::class, 'update'])->name('pelapor.profile_update');
    Route::put('/pelapor/update_password/{id}', [Pelapor_UpdateProfileController::class, 'update_password'])->name('pelapor.password_update');

    Route::post('/pelapor/ponpes_view/report/{id}', [PonpesReportController::class, 'report'])->name('pelapor.ponpes_report');

    Route::get('/pelapor/ponpes/data_report/{id}', [DataReportController::class, 'index'])->name('pelapor.ponpes.data_report');
    Route::delete('/pelapor/ponpes/data_report/delete/{id}', [DataReportController::class, 'delete'])->name('pelapor.ponpes.report_delete');

    // madin
    Route::get('/pelapor/madin/map_view', [Pelapor_Madin_MapViewController::class, 'index'])->name('pelapor.madin.map_view');
    Route::get('/pelapor/madin/map_view/export_xlsx', [Pelapor_Madin_MapViewController::class, 'exportXLSX']);
    Route::get('/pelapor/madin/map_view/export_csv', [Pelapor_Madin_MapViewController::class, 'exportCSV']);

    Route::get('/pelapor/madin/map_facility', [Pelapor_Madin_MapFacilityController::class, 'index'])->name('pelapor.madin.map_facility');
    Route::get('/pelapor/madin/map_facility/search', [Pelapor_Madin_MapFacilityController::class, 'search'])->name('pelapor.madin.search_facility');

    Route::get('/pelapor/madin/madin_view/{id}', [Pelapor_MadinViewController::class, 'index'])->name('pelapor.madin.madin_view');

    Route::post('/pelapor/madin/madin_view/report/{id}', [MadinReportController::class, 'report'])->name('pelapor.madin_report');

    Route::get('/pelapor/data_madin', [Pelapor_DataMadinController::class, 'index'])->name('pelapor.data_madin');
    Route::get('/pelapor/madin_export_xlsx', [Pelapor_DataMadinController::class, 'exportXLSX']);
    Route::get('/pelapor/madin_export_csv', [Pelapor_DataMadinController::class, 'exportCSV']);
    Route::get('/pelapor/data_madin/search', [Pelapor_DataMadinController::class, 'search'])->name('pelapor.madin_search');

    Route::get('/pelapor/madin/data_report/{id}', [Pelapor_Madin_DataReportController::class, 'index'])->name('pelapor.madin.data_report');
    Route::delete('/pelapor/madin/data_report/delete/{id}', [Pelapor_Madin_DataReportController::class, 'delete'])->name('pelapor.madin.report_delete');

    Route::get('/pelapor/panduan', function () {
        return view('pelapor.tutorial_view');
    });
});

// rute untuk register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/belum direlasikan', [BelumBerelasiController::class, 'index'])->name('belum.direlasikan');

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
