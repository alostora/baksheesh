<?php

namespace Guest\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        foreach (glob(base_path('/packages/Guest/routes/*.php')) as $file) {
            Route::prefix('api/guest')
                ->middleware(['api'])
                ->group($file);
        }


        foreach (glob(base_path('/packages/Guest/guest_routes/*.php')) as $file) {
            Route::prefix('guest')
                ->middleware(['web', 'lang'])
                ->group($file);
        }
    }
}
