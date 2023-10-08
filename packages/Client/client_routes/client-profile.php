<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::group([

     'middleware' => [
          'auth:sanctum',
          'is_verified'
     ]

], function () {

     Route::get('client-profile', [ProfileController::class, 'index']);
     Route::post('client-update-profile-request', [ProfileController::class, 'updateProfileRequest']);
     Route::post('client-update-password', [ProfileController::class, 'updatePassword']);
});
