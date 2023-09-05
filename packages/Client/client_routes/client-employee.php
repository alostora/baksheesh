<?php

use Client\Http\Controllers\Views\ClientEmployeeController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('client-employees', [ClientEmployeeController::class, 'index']);

	Route::get('client-employees/search', [ClientEmployeeController::class, 'search']);

	Route::get('client-employee/{user}', [ClientEmployeeController::class, 'show']);

	Route::get('client-employee/create', [ClientEmployeeController::class, 'create']);

	Route::post('client-employee', [ClientEmployeeController::class, 'store']);

	Route::get('client-employee/edit/{user}', [ClientEmployeeController::class, 'edit']);

	Route::patch('client-employee/{user}', [ClientEmployeeController::class, 'update']);

	Route::delete('client-employee/{user}', [ClientEmployeeController::class, 'destroy']);

	Route::any('client-employee/delete/{user}', [ClientEmployeeController::class, 'destroy']);
});
