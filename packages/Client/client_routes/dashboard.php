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
});
