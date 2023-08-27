<?php

use Client\Http\Controllers\ClientEmployeeController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('client-employees', [ClientEmployeeController::class, 'index']);

	Route::get('client-employees/search', [ClientEmployeeController::class, 'search']);

	Route::get('client-employee/{user}', [ClientEmployeeController::class, 'show']);

	Route::post('client-employee', [ClientEmployeeController::class, 'store']);

	Route::patch('client-employee/{user}', [ClientEmployeeController::class, 'update']);

	Route::delete('client-employee/{user}', [ClientEmployeeController::class, 'destroy']);
});
