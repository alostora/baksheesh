<?php

use App\Http\Controllers\DashboardClientController;
use Illuminate\Support\Facades\Route;


Route::group([

    'middleware' => [
        'auth:sanctum',
        'is_verified'
    ]

], function () {

    Route::get('/', [DashboardClientController::class, 'index']);


    Route::get('quick-start-create-company-available-rating', [DashboardClientController::class, 'quickStartViewCreateCompanyAvailableRating']);

    Route::post('quick-start-create-company-available-rating', [DashboardClientController::class, 'quickStartCreateCompanyAvailableRating']);


    Route::get('quick-start-create-employee-available-rating', [DashboardClientController::class, 'quickStartViewCreateEmployeeAvailableRating']);

    Route::post('quick-start-create-employee-available-rating', [DashboardClientController::class, 'quickStartCreateEmployeeAvailableRating']);


    Route::get('quick-start-create-company', [DashboardClientController::class, 'quickStartViewCreateCompany']);

    Route::post('quick-start-create-company', [DashboardClientController::class, 'quickStartCreateCompany']);


    Route::get('quick-start-create-employee/{company}', [DashboardClientController::class, 'quickStartViewCreateemployee']);

    Route::post('quick-start-create-employee', [DashboardClientController::class, 'quickStartCreateemployee']);
});
