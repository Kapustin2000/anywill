<?php

namespace App\Services;

use App\Models\FuneralHome;
use App\Models\Manager;
use App\Services\Dto\FuneralHomeDto;
use App\Services\Dto\ManagerDto;

; 

Class ManagerService extends TransactionAbstractService
{
    protected $manager;

    public function save(ManagerDto $dto) : Manager
    {
        return $this->manager =  Manager::create($dto->data);
    }

    public function update(ManagerDto $dto, Manager $manager) : Manager
    {
        return $manager->update($dto->data);
    }

} 