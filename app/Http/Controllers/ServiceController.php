<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Services\Dto\OrderDto;
use App\Services\Dto\ServiceDto;
use App\Services\ServicesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    protected $service, $repo;
    
    function __construct(ServicesService $service, ServiceRepositoryInterface $repo)
    {
        $this->service = $service;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::enableQueryLog(); // Enable query log
        $idList = [1,2];

        $services = Service::whereIn('id', function ($query) use ($idList) {
             $query->selectRaw('sd1.service_id')
                 ->whereIn('sd1.service_options_id', $idList)
                 ->from('service_dependencies as sd1')
                 ->havingRaw('COUNT(sd1.service_id) = services.dependencies_count')
                 ->groupBy('sd1.service_id');
        })->get();
        dd(DB::getQueryLog()); // Show results of log

        dd($services);

        $services = Service::with('dependencies')
            ->whereHas('dependencies', function ($q){
                $idList = [1,2];
                $q->whereIn('service_options_id', $idList)
                    ->havingRaw('COUNT(service_id) = 2')
                    ->join('contacts', 'users.id', '=', 'contacts.user_id')
                    ->groupBy('service_dependencies.service_id, service_dependencies.service_options_id ');
            })->get();
        dd(DB::getQueryLog()); // Show results of log

        dd($services);
        return $this->repo->all();
    }


    public function store(Request $request)
    {
        return $this->service->transaction(new ServiceDto($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        return $this->service->transaction(new ServiceDto($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        return $service->delete();
    }
}
