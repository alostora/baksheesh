<?php

use Admin\Http\Controllers\Views\Company\EmployeeAvailableRatingController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::get('employee/available-ratings', [EmployeeAvailableRatingController::class, 'index']);

    Route::get('employee-available-ratings/search', [EmployeeAvailableRatingController::class, 'search']);

    Route::get('employee-available-rating/create/{user}', [EmployeeAvailableRatingController::class, 'create']);

    Route::post('employee-available-rating', [EmployeeAvailableRatingController::class, 'store']);

    Route::get('employee-available-rating/edit/{employeeAvailableRating}', [EmployeeAvailableRatingController::class, 'edit']);

    Route::patch('employee-available-rating/{employeeAvailableRating}', [EmployeeAvailableRatingController::class, 'update']);

    Route::delete('employee-available-rating/{employeeAvailableRating}', [EmployeeAvailableRatingController::class, 'destroy']);

    Route::any('employee-available-rating/delete/{employeeAvailableRating}', [EmployeeAvailableRatingController::class, 'destroy']);

    Route::any('employee-available-rating-active/{employeeAvailableRating}', [EmployeeAvailableRatingController::class, 'active']);

    Route::any('employee-available-rating-inactive/{employeeAvailableRating}', [EmployeeAvailableRatingController::class, 'inactive']);
});
