<?php

use Admin\Http\Controllers\Views\Company\CompanyController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::get('companies', [CompanyController::class, 'index']);

    Route::get('companies/search', [CompanyController::class, 'search']);

    Route::get('companies/all', [CompanyController::class, 'allCompanies']);

    Route::get('client-companies/{user}', [CompanyController::class, 'clientCompanies']);

    Route::get('client-companies/search/{user}', [CompanyController::class, 'searchClientCompanies']);

    Route::get('company/create', [CompanyController::class, 'create']);

    Route::get('company/client-company-available-rating/{user}', [CompanyController::class, 'clientCompanyAvailableRatings']);

    Route::post('company', [CompanyController::class, 'store']);

    Route::get('company/edit/{company}', [CompanyController::class, 'edit']);

    Route::patch('company/{company}', [CompanyController::class, 'update']);

    Route::delete('company/{company}', [CompanyController::class, 'destroy']);

    Route::any('company/delete/{company}', [CompanyController::class, 'destroy']);

    Route::any('company-active/{company}', [CompanyController::class, 'active']);

    Route::any('company-inactive/{company}', [CompanyController::class, 'inactive']);
});
