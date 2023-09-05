<?php

use Client\Http\Controllers\Views\ClientWithdrawalRequestController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {


	Route::get('client-withdrawal-requests', [ClientWithdrawalRequestController::class, 'index']);

	Route::get('client-withdrawal-requests/search', [ClientWithdrawalRequestController::class, 'search']);

	Route::get('client-withdrawal-request/create', [ClientWithdrawalRequestController::class, 'create']);

	Route::post('client-withdrawal-request', [ClientWithdrawalRequestController::class, 'store']);

	Route::get('client-withdrawal-request/edit/{clientWithdrawalRequest}', [ClientWithdrawalRequestController::class, 'edit']);

	Route::patch('client-withdrawal-request/{clientWithdrawalRequest}', [ClientWithdrawalRequestController::class, 'update']);

	Route::delete('client-withdrawal-request/{clientWithdrawalRequest}', [ClientWithdrawalRequestController::class, 'destroy']);

	Route::any('client-withdrawal-request/delete/{clientWithdrawalRequest}', [ClientWithdrawalRequestController::class, 'destroy']);
});
