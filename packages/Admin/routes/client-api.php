<?php

use Admin\Http\Controllers\User\ClientController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('clients', [ClientController::class, 'index']);

	Route::get('clients/search', [ClientController::class, 'search']);

	Route::get('client/{user}', [ClientController::class, 'show']);

	Route::post('client', [ClientController::class, 'store']);

	Route::patch('client/{user}', [ClientController::class, 'update']);

	Route::delete('client/{user}', [ClientController::class, 'destroy']);

     Route::patch('client-active/{user}', [ClientController::class, 'active']);

     Route::patch('client-inactive/{user}', [ClientController::class, 'inactive']);
});
