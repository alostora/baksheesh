<?php

use Client\Http\Controllers\Views\ClientCompanyEmployeeController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('client-company-employees', [ClientCompanyEmployeeController::class, 'index']);

	Route::get('client-company-employees/search', [ClientCompanyEmployeeController::class, 'search']);

	Route::get('client-company-employee/create', [ClientCompanyEmployeeController::class, 'create']);

	Route::post('client-company-employee', [ClientCompanyEmployeeController::class, 'store']);

	Route::get('client-company-employee/edit/{user}', [ClientCompanyEmployeeController::class, 'edit']);

	Route::patch('client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'update']);

	Route::delete('client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'destroy']);

	Route::any('client-company-employee/delete/{user}', [ClientCompanyEmployeeController::class, 'destroy']);

	Route::any('client-company-employee-active/{user}', [ClientCompanyEmployeeController::class, 'active']);

	Route::any('client-company-employee-inactive/{user}', [ClientCompanyEmployeeController::class, 'inactive']);

	Route::patch('assigne-client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'assigneCompanyEmployee']);

	Route::patch('unassigne-client-company-employee/{user}', [ClientCompanyEmployeeController::class, 'unAssigneCompanyEmployee']);
});
