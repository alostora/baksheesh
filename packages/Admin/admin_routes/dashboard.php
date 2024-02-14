<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group([

    'middleware' => [
        'auth:sanctum',
        'is_verified'
    ]

], function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('quick-start-create-client', [DashboardController::class, 'quickStartViewCreateClient']);

    Route::post('quick-start-create-client', [DashboardController::class, 'quickStartCreateClient']);


    Route::get('quick-start-create-company-available-rating/{user}', [DashboardController::class, 'quickStartViewCreateCompanyAvailableRating']);

    Route::post('quick-start-create-company-available-rating', [DashboardController::class, 'quickStartCreateCompanyAvailableRating']);


    Route::get('quick-start-create-employee-available-rating/{user}', [DashboardController::class, 'quickStartViewCreateEmployeeAvailableRating']);

    Route::post('quick-start-create-employee-available-rating', [DashboardController::class, 'quickStartCreateEmployeeAvailableRating']);


    Route::get('quick-start-create-company/{user}', [DashboardController::class, 'quickStartViewCreateCompany']);

    Route::post('quick-start-create-company', [DashboardController::class, 'quickStartCreateCompany']);


    Route::get('quick-start-create-employee/{company}', [DashboardController::class, 'quickStartViewCreateemployee']);

    Route::post('quick-start-create-employee', [DashboardController::class, 'quickStartCreateemployee']);
});
