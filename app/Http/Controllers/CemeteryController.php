<?php

namespace App\Http\Controllers;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Services\Dto\CemeteryDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Http\Request;

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
        return $cemetery->with('classifications', 'options', 'coordinates');
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
