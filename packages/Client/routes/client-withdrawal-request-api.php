<?php

use Client\Http\Controllers\ClientWithdrawalRequestController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	
	Route::get('client-withdrawal-requests', [ClientWithdrawalRequestController::class, 'index']);

	Route::get('client-withdrawal-requests/search', [ClientWithdrawalRequestController::class, 'search']);

	Route::get('client-withdrawal-request/{clientWithdrawalRequest}', [ClientWithdrawalRequestController::class, 'show']);

	Route::post('client-withdrawal-request', [ClientWithdrawalRequestController::class, 'store']);

	Route::patch('client-withdrawal-request/{clientWithdrawalRequest}', [ClientWithdrawalRequestController::class, 'update']);

	Route::delete('client-withdrawal-request/{clientWithdrawalRequest}', [ClientWithdrawalRequestController::class, 'destroy']);
});
