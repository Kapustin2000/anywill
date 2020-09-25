<?php

namespace App\Http\Controllers;

use App\Http\Requests\CemeteryRequest;
use App\Models\Address;
use App\Models\Cemetery;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Services\Dto\CemeteryDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CemeteryController extends Controller
{
    protected $service, $repo; 
    
    public function __construct(CemeteryServiceInterface $service, CemeteryRepositoryInterface $repo)
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
//        $lat = 33.5866727;
//        $lng =  33.5866727;
//
//        $address = Address::select('name')
//            ->selectRaw(sqlDistance($lat, $lng))->havingRaw('distance < 20')->get();
//
//        dd($address);
//
        return $this->repo->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->transaction(new CemeteryDto($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function show(Cemetery $cemetery)
    {
        return  $cemetery->load('classifications:id', 'options', 'address');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function update(CemeteryRequest $request, Cemetery $cemetery)
    {
        return $this->service->transaction(new CemeteryDto($request->all()), $cemetery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cemetery $cemetery)
    {
        return $cemetery->delete();
    }
}
