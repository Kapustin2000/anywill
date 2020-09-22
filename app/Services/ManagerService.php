<?php

namespace App\Services;

use App\Models\Manager;
use App\Services\Dto\ManagerDto;

Class ManagerService extends TransactionAbstractService
{
    protected $manager;

    public function save(ManagerDto $dto) : Manager
    {
       $this->manager =  Manager::create($dto->data);
        
       return $this->persistManager($dto); 
    }

    public function update(ManagerDto $dto, Manager $manager) : Manager
    {
        $manager->update($dto->data);

        return $this->persistManager($dto);
    }
    
    protected function persistManager(ManagerDto $dto)
    {
        $this->manager->permissions()->sync($dto->permissions);
        
        return $this->manager;
    }

} 