<?php

use Guest\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::group([
	'prefix' => "payment"
], function () {

	Route::post('pay-for-employee', [PaymentController::class, 'payForEmployee']);
	Route::post('pay-for-company', [PaymentController::class, 'payForCompany']);
});
