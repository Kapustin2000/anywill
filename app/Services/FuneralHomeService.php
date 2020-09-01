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
    protected $funeralHome;

    public function save(FuneralHomeDto $dto) : FuneralHome
    {
        $this->funeralHome =  FuneralHome::create($dto->data);
        
        return $this->persistFuneralHome($dto);
    }

    public function update(FuneralHomeDto $dto, FuneralHome $funeralHome)
    {
        $this->funeralHome = $funeralHome;

        $this->funeralHome->update($dto->data);

        return $this->persistFuneralHome($dto);
    }


    protected function persistFuneralHome(FuneralHomeDto $dto)
    {
        $this->funeralHome->options()->sync($dto->options);

        foreach($dto->rooms as $room) {
            $this->funeralHome->rooms()->updateOrCreate($room);
        }

        return $this->funeralHome;
    }

} 