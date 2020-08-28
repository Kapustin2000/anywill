<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Cremation;
use App\Services\Dto\CremationDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\CremationServiceInterface;
use Illuminate\Http\Request;

Class CremationService extends TransactionAbstractService implements CremationServiceInterface
{
    
    public function save(CremationDto $dto, Cremation $cremation = null) : Cremation
    {
        
        if ($cremation) {
            $cremation->update($dto->data);
        } else {
            $cremation = Cemetery::create($dto->data);
        }
        

        $cremation->options()->sync($dto->options);
        
        return $cremation;
    }

} 