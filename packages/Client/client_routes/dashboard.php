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
});
