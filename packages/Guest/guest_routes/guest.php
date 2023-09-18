<?php

use Guest\Http\Controllers\Views\ReviewController;
use Illuminate\Support\Facades\Route;


Route::group([
	'prefix' => "payment"
], function () {

	Route::post('pay-for-employee', [ReviewController::class, 'payForEmployee']);
	Route::post('pay-for-company', [ReviewController::class, 'payForCompany']);
});
