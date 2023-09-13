<?php

use App\Http\Controllers\AuthViews\AuthController;
use App\Http\Controllers\PaymentForEmployeeController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin',
], function () {


    Route::get('login', [AuthController::class, 'loginView'])->name('login');
    Route::post('login', [AuthController::class, 'login']);



    Route::group([

        'middleware' => [
            'auth:sanctum',
            'is_verified'
        ]

    ], function () {

        Route::any('logout', [AuthController::class, 'logout']);
    });
});


Route::get('pay-for-employee/{user}', [PaymentForEmployeeController::class, 'index']);
