<?php

use Admin\Http\Controllers\Company\CompanyEmployeeController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('company-employees', [CompanyEmployeeController::class, 'index']);

	Route::get('company-employees/search', [CompanyEmployeeController::class, 'search']);

	Route::get('company-employee/{user}', [CompanyEmployeeController::class, 'show']);

	Route::post('company-employee', [CompanyEmployeeController::class, 'store']);

	Route::patch('company-employee/{user}', [CompanyEmployeeController::class, 'update']);

	Route::delete('company-employee/{user}', [CompanyEmployeeController::class, 'destroy']);

	Route::patch('assigne-company-employee/{user}', [CompanyEmployeeController::class, 'assigneCompanyEmployee']);

	Route::patch('unassigne-company-employee/{user}', [CompanyEmployeeController::class, 'unAssigneCompanyEmployee']);

	Route::patch('company-employee-active/{user}', [CompanyEmployeeController::class, 'active']);

	Route::patch('company-employee-inactive/{user}', [CompanyEmployeeController::class, 'inactive']);
});
