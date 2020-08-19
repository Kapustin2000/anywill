<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Cremation;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\CremationServiceInterface;
use Illuminate\Http\Request;

Class CremationService implements CremationServiceInterface
{
    
    public function save(Request $request, Cremation $cremation = null) : Cremation
    {
        
        if ($cremation) {
            $cremation->update($request->all());
        } else {
            $cremation = Cemetery::create($request->all());
        }
        

        $cremation->options()->sync($request->input('options'));
        
        return $cremation;
    }

} 