<?php

use Admin\Http\Controllers\Company\CompanyController;
use Admin\Http\Controllers\User\UserController;
use Guest\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::group([
	'prefix' => "payment"
], function () {

	Route::post('pay-for-company', [ReviewController::class, 'payForCompany']);
    
	Route::post('company-rating/{company}', [ReviewController::class, 'companyRating']);

	Route::post('pay-for-employee', [ReviewController::class, 'payForEmployee']);

	Route::post('employee-rating/{user}', [ReviewController::class, 'employeeRating']);

	Route::get('user/{user}', [UserController::class, 'show']);

	Route::get('company/{company}', [CompanyController::class, 'show']);
});
