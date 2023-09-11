<?php

use Admin\Http\Controllers\Views\Wallet\WithdrawalRequestController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('client-withdrawal-requests/{user}', [WithdrawalRequestController::class, 'index']);

	Route::get('client-withdrawal-requests/search/{user}', [WithdrawalRequestController::class, 'search']);

	Route::get('all-client-withdrawal-requests/search', [WithdrawalRequestController::class, 'searchAllWithdrawalRequests']);

	Route::get('client-withdrawal-request/{clientWithdrawalRequest}', [WithdrawalRequestController::class, 'show']);

	Route::any('client-withdrawal-request/delete/{clientWithdrawalRequest}', [WithdrawalRequestController::class, 'destroy']);

	Route::delete('client-withdrawal-request/{clientWithdrawalRequest}', [WithdrawalRequestController::class, 'destroy']);

	Route::patch('client-withdrawal-request-change-status/{clientWithdrawalRequest}', [WithdrawalRequestController::class, 'changeStatus']);
});
