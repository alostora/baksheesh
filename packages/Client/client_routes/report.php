<?php

use Client\Http\Controllers\Views\Report\ClientReportController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('company-wallet-report', [ClientReportController::class, 'companyWalletReport']);

    Route::get('company-rating-report', [ClientReportController::class, 'companyRatingReport']);

	Route::get('company-notes-report', [ClientReportController::class, 'companyNotesReport']);


	Route::get('employee-wallet-report', [ClientReportController::class, 'employeeWalletReport']);

	Route::get('withdrawal-request-report', [ClientReportController::class, 'withdrawalRequestReport']);

	Route::get('employee-rating-report', [ClientReportController::class, 'employeeRatingReport']);

	Route::get('employee-notes-report', [ClientReportController::class, 'employeeNotesReport']);

});
