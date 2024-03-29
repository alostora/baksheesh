<?php

use Guest\Http\Controllers\Views\ReviewController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => "payment"
], function () {

    Route::post('pay-for-company', [ReviewController::class, 'payForCompany']);

    Route::post('pay-for-employee', [ReviewController::class, 'payForEmployee']);

    Route::any('pay-for-employee/{user}', [ReviewController::class, 'viewPaymentForEmployee']);

    Route::any('pay-for-company/{company}', [ReviewController::class, 'viewPaymentForCompany']);

    Route::any('pay-success', [ReviewController::class, 'viewPaymentSuccessPage']);
});
