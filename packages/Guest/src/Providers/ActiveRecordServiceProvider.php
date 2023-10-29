<?php

namespace Guest\Providers;

use App\Models\EmployeeRating;
use Guest\Observers\EmployeeRatingObserver;
use Illuminate\Support\ServiceProvider;

class ActiveRecordServiceProvider extends ServiceProvider
{

     public function boot()
     {
          EmployeeRating::observe(EmployeeRatingObserver::class);
     }
}
