<?php

use Admin\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::get('home-page', [DashboardController::class, 'index']);
});
