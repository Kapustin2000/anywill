<?php

namespace App\Providers;

use App\Repositories\CemeteryRepository;
use App\Repositories\FuneralHomeRepository;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\CremationRepositoryInterface;
use App\Repositories\Interfaces\FuneralHomeRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Services\CemeteryService;
use App\Services\CremationService;
use App\Services\FuneralHomeService;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\CremationServiceInterface;
use App\Services\Interfaces\FuneralHomeServiceInterface;
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

        $this->app->bind(
            CremationRepositoryInterface::class,
            CemeteryRepository::class
        );
        
        $this->app->bind(
            CremationServiceInterface::class,
            CremationService::class
        );

        $this->app->bind(
            FuneralHomeRepositoryInterface::class,
            FuneralHomeRepository::class
        );

        $this->app->bind(
            FuneralHomeServiceInterface::class,
            FuneralHomeService::class
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
