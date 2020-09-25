<?php

namespace App\Services;


use App\Models\Cremation;
use App\Services\Dto\CremationDto;
use App\Services\Interfaces\CremationServiceInterface;

Class CremationService extends TransactionAbstractService implements CremationServiceInterface
{
    protected $cremation;
    
    public function save(CremationDto $dto) : Cremation
    {
        $this->cremation = Cremation::create($dto->data);
        
        return $this->persistCremation($dto);
    }


    public function update(CremationDto $dto, Cremation $cremation) : Cremation
    {
        $this->cremation = tap($cremation)->update($dto->data);

        return $this->persistCremation($dto);
    }
    
    
    protected function persistCremation(CremationDto $dto) : Cremation
    { 
        $this->persistOptions($this->cremation, $dto->options);

        return $this->cremation;
    }

} 