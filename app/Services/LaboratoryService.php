<?php

namespace App\Services;

use App\Models\Laboratory;
use App\Services\Dto\LaboratoryDto;
use App\Services\Interfaces\LaboratoryServiceInterface;

Class LaboratoryService extends TransactionAbstractService implements LaboratoryServiceInterface {
    
    protected $laboratory;
    
    public function save(LaboratoryDto $dto) : Laboratory
    {
        $this->laboratory = Laboratory::create($dto->data);

        return $this->persistLaboratory($dto);
    }
    
    public function update(LaboratoryDto $dto, Laboratory $laboratory = null) : Laboratory
    {
        $this->laboratory = tap($laboratory)->update($dto->data);
        
        return $this->persistLaboratory($dto);
    }
    
    protected function persistLaboratory(LaboratoryDto $dto)
    {
        $this->persistOptions($this->laboratory, $dto->options);

        $this->persistRelation($this->laboratory->addresses(), $dto->addresses);

        return  $this->laboratory;
    }

} 