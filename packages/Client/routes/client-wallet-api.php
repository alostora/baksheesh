<?php

use Client\Http\Controllers\ClientWalletController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('company-wallets', [ClientWalletController::class, 'companyWallets']);
	Route::get('employee-wallets', [ClientWalletController::class, 'employeeWallets']);
});
