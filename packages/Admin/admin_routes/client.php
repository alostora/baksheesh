<?php

use Admin\Http\Controllers\Views\User\ClientController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified']
], function () {

	Route::get('clients', [ClientController::class, 'index']);

	Route::get('clients/search', [ClientController::class, 'search']);

	Route::get('client/create', [ClientController::class, 'create']);

	Route::post('client', [ClientController::class, 'store']);

	Route::get('client/edit/{user}', [ClientController::class, 'edit']);

	Route::patch('client/{user}', [ClientController::class, 'update']);

	Route::delete('client/{user}', [ClientController::class, 'destroy']);

	Route::any('client/delete/{user}', [ClientController::class, 'destroy']);

	Route::any('client-active/{user}', [ClientController::class, 'active']);

	Route::any('client-inactive/{user}', [ClientController::class, 'inactive']);
});
