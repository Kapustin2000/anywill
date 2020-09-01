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
    protected $cremation;
    
    public function save(CremationDto $dto) : Cremation
    {
        $this->cremation = Cemetery::create($dto->data);
        
        return $this->persistCremation($dto);
    }


    public function update(CremationDto $dto, Cremation $cremation) : Cremation
    {
        $this->cremation = $cremation;

        $this->cremation->update($dto->data);

        return $this->persistCremation($dto);
    }
    
    
    protected function persistCremation(CremationDto $dto) : Cremation
    {
        $this->cremation->options()->sync($dto->options);
        
        return $this->cremation;
    }

} 