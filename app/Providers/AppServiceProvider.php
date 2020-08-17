<?php

namespace App\Providers;

use App\Repositories\CemeteryRepository;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Services\CemeteryService;
use App\Services\Interfaces\CemeteryServiceInterface;
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
        $this->app->bind(
            CemeteryServiceInterface::class,
            CemeteryService::class
        );

        $this->app->bind(
            CemeteryRepositoryInterface::class,
            CemeteryRepository::class
        );

        $this->app->bind(
            ServiceRepositoryInterface::class,
            ServiceRepository::class
        );
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
