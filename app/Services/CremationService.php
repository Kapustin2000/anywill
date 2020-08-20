<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Cremation;
use App\Services\Dto\CremationDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\CremationServiceInterface;
use Illuminate\Http\Request;

Class CremationService implements CremationServiceInterface
{
    
    public function save(CremationDto $data, Cremation $cremation = null) : Cremation
    {
        
        if ($cremation) {
            $cremation->update($data->toArray());
        } else {
            $cremation = Cemetery::create($data->toArray());
        }
        

        $cremation->options()->sync($data->options);
        
        return $cremation;
    }

} 