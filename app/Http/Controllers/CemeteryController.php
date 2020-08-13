<?php

namespace App\Http\Controllers;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Http\Request;

class CemeteryController extends Controller
{
    protected $service; 
    
    public function __construct(CemeteryServiceInterface $service)
    {
       $this->service = $service;    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CemeteryRequest $request)
    {
        return $this->service->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function show(Cemetery $cemetery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function edit(Cemetery $cemetery)
    {
        //
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
        return $this->service->save($request, $cemetery);
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
