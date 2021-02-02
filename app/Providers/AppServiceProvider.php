<?php

namespace App\Providers;

use App\Models\GroupUserPivot;
use App\Observers\GroupUserPivotObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        GroupUserPivot::observe(GroupUserPivotObserver::class);
    }
}
