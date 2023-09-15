<?php

namespace Admin\Providers;

use App\Models\Country;
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
        foreach (glob(base_path('/packages/Admin/routes/*.php')) as $file) {
            Route::prefix('api/admin')
                ->middleware(['api'])
                ->group($file);
        }

        foreach (glob(base_path('/packages/Admin/admin_routes/*.php')) as $file) {
            Route::prefix('admin')
                ->middleware(['web','lang'])
                ->group($file);
        }

        $this->bindRoutes($router);
    }

    protected function bindRoutes(Router $router)
    {
        $router->bind('country', function ($value) {
            return Country::loadCountry($value);
        });

        $router->bind('governorate', function ($value) {
            return Country::loadGovernorate($value);
        });

        $router->bind('city', function ($value) {
            return Country::loadCity($value);
        });

        $router->bind('zone', function ($value) {
            return Country::loadZone($value);
        });

        $router->bind('district', function ($value) {
            return Country::loadDistrict($value);
        });
    }
}
