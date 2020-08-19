<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Cremation;
use App\Models\FuneralHome;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\CremationServiceInterface;
use App\Services\Interfaces\FuneralHomeServiceInterface;
use Illuminate\Http\Request;

Class FuneralHomeService implements FuneralHomeServiceInterface
{
    
    public function save(Request $request, FuneralHome $funeralHome = null) : FuneralHome
    {
        
        if ($funeralHome) {
            $funeralHome->update($request->all());
        } else {
            $funeralHome = FuneralHome::create($request->all());
        }


        $funeralHome->options()->sync($request->input('options'));
        
        return $funeralHome;
    }

} 