<?php


use App\Http\Controllers\{
    BarangayInformationController,
    BarangayOfficialsController,
    BlotterController,
    BusinessPermitController,
    ChairmanshipController,
    CovidStatusController,
    HouseholdsController,
    PositionsController,
    ResidentsController,
    RevenueController,
    ZonesController,
    AuthController,
    CertificationController,
    CertificationRequestController,
    GcashController,
    GcashQRController,
    AnnouncementController,
    UserController,
    FileController,
    LogsController
};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('check-token', [AuthController::class, 'checkToken']);

Route::group(['middleware' => 'api'], function () {
    Route::get('search-id', [ResidentsController::class, 'findByResidentID']);
    Route::get('count-active', [BlotterController::class, 'countActiveCases']);
    Route::get('count-settled', [BlotterController::class, 'countSettledCases']);
    Route::get('count-scheduled', [BlotterController::class, 'countScheduledCases']);

    Route::post('get-revenue', [RevenueController::class, 'getRevenue']);

    Route::post('find-resident', [ResidentsController::class, 'findResident']);
    Route::get('count-population', [ResidentsController::class, 'countPopulation']);
    Route::get('count-total-population', [ResidentsController::class, 'countTotalPopulation']);
    Route::get('pending-residents', [ResidentsController::class, 'pendingResidents']);

    Route::post('find-officials', [BarangayOfficialsController::class, 'findOfficial']);
    Route::post('find-officials-id', [BarangayOfficialsController::class, 'findOfficialID']);

    Route::post('find-covid', [CovidStatusController::class, 'findCovid']);
    Route::get('count-unvaccinated', [CovidStatusController::class, 'countUnvaccinated']);
    Route::get('count-first-dose', [CovidStatusController::class, 'countFirstDose']);
    Route::get('count-second-dose', [CovidStatusController::class, 'countSecondDose']);
    Route::get('count-booster', [CovidStatusController::class, 'countBooster']);
    Route::get('blotter-print', [BlotterController::class, 'blotter_print']);

    Route::get('get-positions', [PositionsController::class, 'getPositions']);

    Route::post('update-profile', [BarangayOfficialsController::class, 'updateProfile']);
    Route::post('update-resident-profile', [ResidentsController::class, 'updateProfile']);
    Route::post('update-admin-profile', [ResidentsController::class, 'updateAdminProfile']);
    Route::post('accept-user', [ResidentsController::class, 'acceptUser']);

    Route::post('search-gcash', [GcashController::class, 'findGcash']);

    Route::post('find-resident-certificate', [CertificationRequestController::class, 'findResident']);

    Route::post('total-revenue-year', [RevenueController::class, 'getTotalRevenue']);
    Route::get('total-revenue-month', [RevenueController::class, 'getTotalRevenueByMonth']);

    Route::post('certification-request', [CertificationRequestController::class, 'updateCertificates']);

    Route::get('exportDB', [BarangayInformationController::class, 'getDB']);

    Route::post('updateStatus', [UserController::class, 'updateStatus']);
    Route::get('getOfficials', [BarangayOfficialsController::class, 'getOfficials']);

    Route::post('formSubmit', [FileController::class, 'formSubmit']);
    Route::get('report-type', [FileController::class, 'reportType']);
    Route::get('download', [FileController::class, 'download']);

    Route::apiResource('barangay_info', BarangayInformationController::class);
    Route::put('update-info', [BarangayInformationController::class, 'update']);
    Route::apiResource('barangay_officals', BarangayOfficialsController::class);
    Route::apiResource('blotter', BlotterController::class);
    Route::apiResource('business_permit', BusinessPermitController::class);
    Route::apiResource('chairmanship', ChairmanshipController::class);
    Route::apiResource('covid', CovidStatusController::class);
    Route::apiResource('household', HouseholdsController::class);
    Route::apiResource('position', PositionsController::class);
    Route::apiResource('resident', ResidentsController::class);
    Route::apiResource('revenue', RevenueController::class);
    Route::apiResource('zones', ZonesController::class);
    Route::apiResource('certification_request', CertificationRequestController::class);
    Route::apiResource('certification', CertificationController::class);
    Route::apiResource('gcash', GcashController::class);
    Route::apiResource('gcashQR', GcashQRController::class);
    Route::apiResource('announcement', AnnouncementController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('file', FileController::class);
    Route::apiResource('logs', LogsController::class);
});
