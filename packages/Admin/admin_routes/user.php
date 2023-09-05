<?php

use Admin\Http\Controllers\Views\User\UserController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('users', [UserController::class, 'index']);

	Route::get('users/search', [UserController::class, 'search']);

	Route::get('user/create', [UserController::class, 'create']);

	Route::post('user', [UserController::class, 'store']);

	Route::get('user/edit/{user}', [UserController::class, 'edit']);

	Route::patch('user/{user}', [UserController::class, 'update']);

	Route::delete('user/{user}', [UserController::class, 'destroy']);

	Route::any('user/delete/{user}', [UserController::class, 'destroy']);
});
