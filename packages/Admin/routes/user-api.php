<?php

use Admin\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('users', [UserController::class, 'index']);

	Route::get('users/search', [UserController::class, 'search']);

	Route::get('user/{user}', [UserController::class, 'show']);

	Route::post('user', [UserController::class, 'store']);

	Route::patch('user/{user}', [UserController::class, 'update']);

	Route::delete('user/{user}', [UserController::class, 'destroy']);

     Route::patch('user-active/{user}', [UserController::class, 'active']);

     Route::patch('user-inactive/{user}', [UserController::class, 'inactive']);
});
