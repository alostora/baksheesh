<?php

use Client\Http\Controllers\Views\ClientCompanyController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('client-companies', [ClientCompanyController::class, 'index']);

	Route::get('client-companies/search', [ClientCompanyController::class, 'search']);

	Route::get('client-company/create', [ClientCompanyController::class, 'create']);

	Route::post('client-company', [ClientCompanyController::class, 'store']);

	Route::get('client-company/edit/{company}', [ClientCompanyController::class, 'edit']);

	Route::patch('client-company/{company}', [ClientCompanyController::class, 'update']);

	Route::delete('client-company/{company}', [ClientCompanyController::class, 'destroy']);

	Route::any('client-company/delete/{company}', [ClientCompanyController::class, 'destroy']);
});
