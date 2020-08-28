<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Cremation;
use App\Models\FuneralHome;
use App\Services\Dto\FuneralHomeDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\CremationServiceInterface;
use App\Services\Interfaces\FuneralHomeServiceInterface;
use Illuminate\Http\Request;

Class FuneralHomeService extends TransactionAbstractService implements FuneralHomeServiceInterface
{
    
    public function save(FuneralHomeDto $dto, FuneralHome $funeralHome = null) : FuneralHome
    {
        
        if ($funeralHome) {
            $funeralHome->update($dto->data);
        } else {
            $funeralHome = FuneralHome::create($dto->data);
        }


        $funeralHome->options()->sync($dto->options);
        
        return $funeralHome;
    }

} 