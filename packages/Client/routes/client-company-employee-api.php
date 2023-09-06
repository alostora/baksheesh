<?php

use Client\Http\Controllers\ClientCompanyEmployeeController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('client-company-employees', [ClientCompanyEmployeeController::class, 'index']);

	Route::get('client-company-employees/search', [ClientCompanyEmployeeController::class, 'search']);

	Route::get('client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'show']);

	Route::post('client-company-employee', [ClientCompanyEmployeeController::class, 'store']);

	Route::patch('client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'update']);

	Route::delete('client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'destroy']);

	Route::patch('assigne-client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'assigneCompanyEmployee']);

	Route::patch('unassigne-client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'unAssigneCompanyEmployee']);

	Route::patch('client-company-employee-active/{user}', [ClientCompanyEmployeeController::class, 'active']);

	Route::patch('client-company-employee-inactive/{user}', [ClientCompanyEmployeeController::class, 'inactive']);

});
