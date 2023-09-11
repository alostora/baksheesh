<?php

use Admin\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('employees', [EmployeeController::class, 'index']);
});
