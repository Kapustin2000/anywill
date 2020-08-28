<?php

namespace App\Services;

use App\Models\Laboratory;
use App\Services\Dto\LaboratoryDto;
use App\Services\Interfaces\LaboratoryServiceInterface;
use Illuminate\Http\Request;

Class LaboratoryService extends TransactionAbstractService implements LaboratoryServiceInterface {


    public function save(LaboratoryDto $dto, Laboratory $laboratory = null) : Laboratory
    {
        if($laboratory) {
            $laboratory->save($dto->data);
        }else {
            $laboratory = Laboratory::create($dto->data);
        }
        
        $laboratory->options()->sync($dto->options);
        
        return $laboratory;
    }

} 