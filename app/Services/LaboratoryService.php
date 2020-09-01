<?php

namespace App\Services;

use App\Models\Laboratory;
use App\Services\Dto\LaboratoryDto;
use App\Services\Interfaces\LaboratoryServiceInterface;
use Illuminate\Http\Request;

Class LaboratoryService extends TransactionAbstractService implements LaboratoryServiceInterface {
    
    protected $laboratory;
    
    public function save(LaboratoryDto $dto) : Laboratory
    {
        $this->laboratory = Laboratory::create($dto->data);

        return $this->persistLaboratory($dto);
    }
    
    public function update(LaboratoryDto $dto, Laboratory $laboratory = null) : Laboratory
    {
        $this->laboratory = $laboratory;
        
        $this->laboratory->update($dto->data);
        
        return $this->persistLaboratory($dto);
    }
    
    protected function persistLaboratory(LaboratoryDto $dto)
    {
        $this->laboratory->options()->sync($dto->options);
        
        return  $this->laboratory;
    }

} 