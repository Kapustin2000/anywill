<?php

namespace App\Services;

use App\Models\FuneralHome;
use App\Services\Dto\FuneralHomeDto;;
use App\Services\Interfaces\FuneralHomeServiceInterface;

Class FuneralHomeService extends TransactionAbstractService implements FuneralHomeServiceInterface
{
    protected $funeralHome;

    public function save(FuneralHomeDto $dto) : FuneralHome
    {
        $this->funeralHome =  FuneralHome::create($dto->data);
        
        return $this->persistFuneralHome($dto);
    }

    public function update(FuneralHomeDto $dto, FuneralHome $funeralHome) : FuneralHome
    {
        $this->funeralHome = $funeralHome;

        $this->funeralHome->update($dto->data);

        return $this->persistFuneralHome($dto);
    }


    protected function persistFuneralHome(FuneralHomeDto $dto)
    {
        $this->persistOptions($this->funeralHome, $dto->options);

        $this->persistRooms($dto->rooms);

        return $this->funeralHome;
    }

    protected function persistRooms($rooms)
    {
        if($rooms) {
            $needsUpdate = array_column($rooms, 'id');

            $this->funeralHome->rooms()->whereNotIn('id', $needsUpdate)->delete();

            foreach($rooms as $room) {
                $this->funeralHome->rooms()->updateOrCreate(['id' => $room['id'] ?? null], $room);
            }
        }

        return $this->funeralHome;
    }

} 