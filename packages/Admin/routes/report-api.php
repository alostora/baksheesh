<?php

use Admin\Http\Controllers\Report\AdminReportController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('company-wallet-report', [AdminReportController::class, 'companyWalletReport']);

	Route::get('employee-wallet-report', [AdminReportController::class, 'employeeWalletReport']);
	
	Route::get('withdrawal-request-report', [AdminReportController::class, 'withdrawalRequestReport']);
	
	Route::get('inactive-client-report', [AdminReportController::class, 'inactiveClientReport']);
});
