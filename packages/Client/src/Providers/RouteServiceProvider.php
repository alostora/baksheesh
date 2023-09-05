<?php

namespace Client\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (glob(base_path('/packages/Client/routes/*.php')) as $file) {
            Route::prefix('api/client')
                ->middleware(['api'])
                ->group($file);
        }

        foreach (glob(base_path('/packages/Client/client_routes/*.php')) as $file) {
            Route::prefix('client')
                ->middleware(['web'])
                ->group($file);
        }
    }
}
