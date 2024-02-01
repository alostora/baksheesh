<?php

use Admin\Http\Controllers\Views\Company\CompanyAvailableRatingController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::get('company/available-ratings', [CompanyAvailableRatingController::class, 'index']);

    Route::get('company-available-ratings/search', [CompanyAvailableRatingController::class, 'search']);

    Route::get('company-available-rating/create/{company}', [CompanyAvailableRatingController::class, 'create']);

    Route::post('company-available-rating', [CompanyAvailableRatingController::class, 'store']);

    Route::get('company-available-rating/edit/{companyAvailableRating}', [CompanyAvailableRatingController::class, 'edit']);

    Route::patch('company-available-rating/{companyAvailableRating}', [CompanyAvailableRatingController::class, 'update']);

    Route::delete('company-available-rating/{companyAvailableRating}', [CompanyAvailableRatingController::class, 'destroy']);

    Route::any('company-available-rating/delete/{companyAvailableRating}', [CompanyAvailableRatingController::class, 'destroy']);

    Route::any('company-available-rating-active/{companyAvailableRating}', [CompanyAvailableRatingController::class, 'active']);

    Route::any('company-available-rating-inactive/{companyAvailableRating}', [CompanyAvailableRatingController::class, 'inactive']);
});
