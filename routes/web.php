<?php

use App\Http\Controllers\ErrorMovePageController;
use App\Http\Controllers\ErrorPageController;
use Illuminate\Support\Facades\Route;

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



Auth::routes();

//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/signout', [App\Http\Controllers\HomeController::class, 'signout'])->name('signout');

Route::middleware(['PreventBackHistory','auth','isAdmin'])->prefix('admin')->name('admin.')->group(function(){
    Route::resources([
        'information' =>App\Http\Controllers\Admin\InformationController::class,
        'background' =>App\Http\Controllers\Admin\BackgroundsController::class,
        'organization' =>App\Http\Controllers\Admin\OrganizationalController::class,
        'report' =>App\Http\Controllers\Admin\ReportsController::class,
        'monthly' =>App\Http\Controllers\Admin\MonthlyReportsController::class,
        'staff' =>App\Http\Controllers\Admin\StaffReportsController::class,
        'province' =>App\Http\Controllers\ProvinceController::class,
        'municipal' =>App\Http\Controllers\MunicipalController::class,
        'barangay' =>App\Http\Controllers\BarangaysController::class,
        'dashboard' =>App\Http\Controllers\Admin\DashboardController::class,
        'setting' =>App\Http\Controllers\Admin\SettingsController::class,
        'official' =>App\Http\Controllers\Admin\OfficialsController::class,
        'position' =>App\Http\Controllers\Admin\PositionsController::class,
        'district' =>App\Http\Controllers\Admin\DistrictsController::class,
        'resident' =>App\Http\Controllers\Admin\ResidentsController::class,
        'project' =>App\Http\Controllers\Admin\ProjectsController::class,
        'insurance' =>App\Http\Controllers\Admin\InsuranceCertificateController::class,
        'indigency' =>App\Http\Controllers\Admin\IndigencyCertificateController::class,
        'loan' =>App\Http\Controllers\Admin\LoanCertificateController::class,
        'death' =>App\Http\Controllers\Admin\DeathCertificateController::class,
        'business' =>App\Http\Controllers\Admin\BusinessController::class,
        'admin' =>App\Http\Controllers\Admin\AdminController::class,
        'residentlist' =>App\Http\Controllers\Admin\ResidentsListController::class,
        'file' =>App\Http\Controllers\Admin\FileController::class,
        'certificate' =>App\Http\Controllers\Admin\CertificatesController::class,
    ]);


    // Route::get('/official/list/{official}', [App\Http\Controllers\Admin\OfficialsController::class, 'list'])->name('official.list');
    Route::get('/official/certificate/{official}', [App\Http\Controllers\Admin\OfficialsController::class, 'certificate'])->name('official.certificate');

    Route::patch('/report/done/{report}', [App\Http\Controllers\Admin\ReportsController::class, 'done'])->name('report.done');
    Route::patch('/report/progress/{report}', [App\Http\Controllers\Admin\ReportsController::class, 'progress'])->name('report.progress');
    Route::patch('/report/pending/{report}', [App\Http\Controllers\Admin\ReportsController::class, 'pending'])->name('report.pending');
    Route::get('/resident/detail/{resident}', [App\Http\Controllers\Admin\ResidentsController::class, 'detail'])->name('resident.detail');


    Route::get('/resident/list/{resident}', [App\Http\Controllers\Admin\ResidentsListController::class, 'detail'])->name('residentlist.detail');
    Route::post('/resident/upload', [App\Http\Controllers\Admin\ResidentsListController::class, 'upload'])->name('residentlist.upload');
    Route::get('/resident/display/{resident}', [App\Http\Controllers\Admin\ResidentsListController::class, 'display'])->name('residentlist.display');

    Route::get('/resident/province/{resident}', [App\Http\Controllers\Admin\ResidentsListController::class, 'province'])->name('residentlist.province');
    Route::get('/resident/municipal/{resident}', [App\Http\Controllers\Admin\ResidentsListController::class, 'municipal'])->name('residentlist.municipal');
    Route::get('/resident/barangay/{resident}', [App\Http\Controllers\Admin\ResidentsListController::class, 'barangay'])->name('residentlist.barangay');

    Route::get('/resident/indigency/file/{resident}', [App\Http\Controllers\Admin\IndigencyCertificateController::class, 'file'])->name('indigency.file');
    Route::get('/resident/indigency/list/{resident}', [App\Http\Controllers\Admin\IndigencyCertificateController::class, 'list'])->name('indigency.list');
    Route::get('/resident/indigency/format/{format}', [App\Http\Controllers\Admin\IndigencyCertificateController::class, 'format'])->name('indigency.format');

    Route::get('/resident/business/list/{resident}', [App\Http\Controllers\Admin\BusinessController::class, 'list'])->name('business.list');
    Route::get('/resident/business/format/{format}', [App\Http\Controllers\Admin\BusinessController::class, 'format'])->name('business.format');

    //Route::get('/resident/death/file/{resident}', [App\Http\Controllers\Admin\DeathCertificateController::class, 'file'])->name('death.file');
    Route::get('/resident/death/list/{resident}', [App\Http\Controllers\Admin\DeathCertificateController::class, 'list'])->name('death.list');
    Route::get('/resident/death/format/{format}', [App\Http\Controllers\Admin\DeathCertificateController::class, 'format'])->name('death.format');

    //Route::get('/resident/death/file/{resident}', [App\Http\Controllers\Admin\LoanCertificateController::class, 'file'])->name('death.file');
    Route::get('/resident/loan/list/{resident}', [App\Http\Controllers\Admin\LoanCertificateController::class, 'list'])->name('loan.list');
    Route::get('/resident/loan/format/{format}', [App\Http\Controllers\Admin\LoanCertificateController::class, 'format'])->name('loan.format');

    //profile
    Route::patch('/admin/admin/profile/{user}', [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('admin.profile');

    Route::get('/residentlist/view/{file}/{resident}', [App\Http\Controllers\Admin\ResidentsListController::class, 'viewfile'])->name('residentlist.viewfile');
    Route::post('/residentlist/file', [App\Http\Controllers\Admin\ResidentsListController::class, 'storefile'])->name('residentlist.storefile');

    Route::get('/residentlist/showfile/{file}/', [App\Http\Controllers\Admin\ResidentsListController::class, 'showfile'])->name('residentlist.showfile');
    Route::post('/residentlist/reprint/{file}/', [App\Http\Controllers\Admin\ResidentsListController::class, 'reprint'])->name('residentlist.reprint');

    Route::get('/certificate/showfile/{resident}/{file}/', [App\Http\Controllers\Admin\CertificatesController::class, 'showfile'])->name('certificate.showfile');

    Route::get('/report/file/{report}', [App\Http\Controllers\Admin\ReportsController::class, 'file'])->name('report.file');

    Route::get('/404', ErrorPageController::class)->name('error404');
    Route::get('/301', ErrorMovePageController::class)->name('error301');

    Route::get('/monthly/print/{monthly}', [App\Http\Controllers\Admin\MonthlyReportsController::class, 'print'])->name('monthly.print');
});

Route::middleware(['PreventBackHistory','auth','isFaculty'])->prefix('faculty')->name('faculty.')->group(function(){
    Route::resources([
        'dashboard' =>App\Http\Controllers\Faculty\DashboardController::class,
    ]);
});

