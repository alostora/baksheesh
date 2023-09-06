<?php

use Admin\Http\Controllers\Company\CompanyController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('companies', [CompanyController::class, 'index']);

	Route::get('companies/search', [CompanyController::class, 'search']);

	Route::get('client-companies/{user}', [CompanyController::class, 'clientCompanies']);

	Route::get('client-companies/search/{user}', [CompanyController::class, 'searchClientCompanies']);

	Route::get('company/{company}', [CompanyController::class, 'show']);

	Route::post('company', [CompanyController::class, 'store']);

	Route::patch('company/{company}', [CompanyController::class, 'update']);

	Route::delete('company/{company}', [CompanyController::class, 'destroy']);

     Route::patch('company-active/{company}', [CompanyController::class, 'active']);

     Route::patch('company-inactive/{company}', [CompanyController::class, 'inactive']);
});
