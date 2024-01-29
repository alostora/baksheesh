<?php

use Admin\Http\Controllers\Country\CountryController;
use Admin\Http\Controllers\Country\GovernorateController;
use Illuminate\Support\Facades\Route;


Route::group([
     'middleware' => 'auth:sanctum',
], function () {

     Route::get('countries', [CountryController::class, 'index']);

     Route::get('countries/search', [CountryController::class, 'search']);

     Route::post('country', [CountryController::class, 'store']);

     Route::get('country/{country}', [CountryController::class, 'show']);

     Route::patch('country/{country}', [CountryController::class, 'update']);

     Route::delete('country/{country}', [CountryController::class, 'destroy']);

     Route::patch('country-active/{country}', [CountryController::class, 'active']);

     Route::patch('country-inactive/{country}', [CountryController::class, 'inactive']);


     Route::get('governorates/{country}', [GovernorateController::class, 'index']);

     Route::get('governorates/search/{country}', [GovernorateController::class, 'search']);

     Route::get('governorates-search-all', [GovernorateController::class, 'searchAll']);

     Route::post('governorate', [GovernorateController::class, 'store']);

     Route::get('governorate/{governorate}', [GovernorateController::class, 'show']);

     Route::patch('governorate/{governorate}', [GovernorateController::class, 'update']);

     Route::delete('governorate/{governorate}', [GovernorateController::class, 'destroy']);

     Route::patch('governorate-active/{governorate}', [GovernorateController::class, 'active']);

     Route::patch('governorate-inactive/{governorate}', [GovernorateController::class, 'inactive']);

});
