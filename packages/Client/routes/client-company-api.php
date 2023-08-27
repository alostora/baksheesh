<?php

use Client\Http\Controllers\ClientCompanyController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('client-companies', [ClientCompanyController::class, 'index']);

	Route::get('client-companies/search', [ClientCompanyController::class, 'search']);

	Route::get('client-company/{company}', [ClientCompanyController::class, 'show']);

	Route::post('client-company', [ClientCompanyController::class, 'store']);

	Route::patch('client-company/{company}', [ClientCompanyController::class, 'update']);

	Route::delete('client-company/{company}', [ClientCompanyController::class, 'destroy']);
});
