<?php

use Admin\Http\Controllers\Company\CompanyController;
use Admin\Http\Controllers\User\UserController;
use Guest\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => "payment"
], function () {

    Route::post('company-note', [ReviewController::class, 'companyNote']);

    Route::post('company-rating/{company}', [ReviewController::class, 'companyRating']);

    Route::post('employee-note', [ReviewController::class, 'employeeNote']);

    Route::post('employee-rating/{user}', [ReviewController::class, 'employeeRating']);

    Route::any('user/{user}', [UserController::class, 'show']);

    Route::any('company/{company}', [CompanyController::class, 'show']);
});
