<?php

namespace App\Providers;

use App\Services\ChurchService;
use App\Services\MinistryService;
use App\Contractors\ChurchInterface;
use App\Contractors\MinistryInterface;
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
        $this->app->singleton(ChurchInterface::class, ChurchService::class);
        $this->app->singleton(MinistryInterface::class, MinistryService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
