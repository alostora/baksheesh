<?php

use Admin\Http\Controllers\Views\Report\AdminReportController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::get('company-wallet-report', [AdminReportController::class, 'companyWalletReport']);

    Route::get('company-rating-report', [AdminReportController::class, 'companyRatingReport']);

    Route::get('company-notes-report', [AdminReportController::class, 'companyNotesReport']);



    Route::get('employee-wallet-report', [AdminReportController::class, 'employeeWalletReport']);

    Route::get('employee-rating-report', [AdminReportController::class, 'employeeRatingReport']);

    Route::get('employee-notes-report', [AdminReportController::class, 'employeeNotesReport']);



    Route::get('withdrawal-request-report', [AdminReportController::class, 'withdrawalRequestReport']);

    Route::get('inactive-client-report', [AdminReportController::class, 'inactiveClientReport']);
});
