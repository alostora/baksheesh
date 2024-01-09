<?php

use Client\Http\Controllers\DashboardClientController;
use Illuminate\Support\Facades\Route;


Route::group([

     'middleware' => [
          'auth:sanctum',
          'is_verified'
     ]

], function () {

     Route::get('home-page', [DashboardClientController::class, 'index']);
});
