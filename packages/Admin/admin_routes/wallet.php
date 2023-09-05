<?php

use Admin\Http\Controllers\Views\Wallet\WalletController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('company-wallets', [WalletController::class, 'companyWallets']);
	Route::get('employee-wallets', [WalletController::class, 'employeeWallets']);

});
