<?php

use Admin\Http\Controllers\Company\CompanyController;
use Admin\Http\Controllers\Company\CompanyEmployeeController;
use Admin\Http\Controllers\Country\CountryController;
use Admin\Http\Controllers\Country\GovernorateController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SystemLookupController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::group([
        'prefix' => 'auth'
    ], function () {

        Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(['auth:sanctum', 'is_verified']);

        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:sanctum', 'is_verified']);

        Route::any('logout', [AuthController::class, 'logout'])->withoutMiddleware('is_verified');

        Route::patch('send-verify-email-code', [EmailVerificationController::class, 'sendVerificationEmail'])->withoutMiddleware('is_verified');

        Route::patch('verify-email', [EmailVerificationController::class, 'verifyEmail'])->withoutMiddleware('is_verified');

        Route::patch('reset-password', [ResetPasswordController::class, 'resetPassword'])->withoutMiddleware(['auth:sanctum', 'is_verified']);

        Route::patch('send-reset-password-code', [ResetPasswordController::class, 'sendResetPassword'])->withoutMiddleware(['auth:sanctum', 'is_verified']);

        Route::get('profile', [ProfileController::class, 'show']);

        Route::patch('profile', [ProfileController::class, 'update']);
    });

    Route::group([
        'prefix' => 'storage'
    ], function () {

        Route::get('files', [FileController::class, 'index']);

        Route::post('file', [FileController::class, 'store']);

        Route::get('file/{file}', [FileController::class, 'show']);

        Route::delete('file/{file}', [FileController::class, 'destroy']);
    });
});

Route::group([
    'prefix' => 'country'
], function () {

    Route::get('countries', [CountryController::class, 'index']);

    Route::get('countries/search', [CountryController::class, 'search']);

    Route::get('country/{country}', [CountryController::class, 'show']);

    Route::get('governorates/{country}', [GovernorateController::class, 'index']);

    Route::get('governorates/search/{country}', [GovernorateController::class, 'search']);

    Route::get('governorate/{governorate}', [GovernorateController::class, 'show']);
});


Route::get('system-lookup-types', [SystemLookupController::class, 'lookupTypes']);

Route::get('system-lookups/{type}', [SystemLookupController::class, 'index']);



Route::get('client-list-companies/{user}', [CompanyController::class, 'clientCompanies']);

Route::get('company-list-employees', [CompanyEmployeeController::class, 'search']);
