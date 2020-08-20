<?php

namespace App\Providers;

use App\Repositories\CemeteryRepository;
use App\Repositories\FuneralHomeRepository;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\CremationRepositoryInterface;
use App\Repositories\Interfaces\FuneralHomeRepositoryInterface;
use App\Repositories\Interfaces\LaboratoryRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\LaboratoryRepository;
use App\Repositories\ServiceRepository;
use App\Services\CemeteryService;
use App\Services\CremationService;
use App\Services\FuneralHomeService;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\CremationServiceInterface;
use App\Services\Interfaces\FuneralHomeServiceInterface;
use App\Services\Interfaces\LaboratoryServiceInterface;
use App\Services\LaboratoryService;
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
        $repositories = [
            'Cemetery',
            'Laboratory',
            'Cremation',
            'FuneralHome',
            'Service',
            'Order'
        ];

        foreach ($repositories as $repo) {
            $this->app->bind(
                'App\Repositories\Interfaces\\'.$repo.'RepositoryInterface',
                'App\Repositories\\'.$repo.'Repository'
            );
        }


        $services = [
            'Cemetery',
            'Laboratory',
            'Cremation',
            'FuneralHome',
            'Service',
            'ImageUpload',
            'Order'
        ];

        foreach ($services as $service) {
            $this->app->bind(
                'App\Services\Interfaces\\'.$service.'ServiceInterface',
                'App\Services\\'.$service.'Service'
            );
        } 
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
