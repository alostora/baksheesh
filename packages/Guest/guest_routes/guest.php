<?php

use Guest\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::group([
	'prefix' => "payment"
], function () {

	Route::post('pay-for-company', [ReviewController::class, 'payForCompany']);

	Route::post('pay-for-employee', [ReviewController::class, 'payForEmployee']);

	Route::get('pay-for-employee/{user}', [ReviewController::class, 'viewPaymentForEmployee']);

	Route::get('pay-for-company/{company}', [ReviewController::class, 'viewPaymentForCompany']);
});
