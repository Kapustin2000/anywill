<?php

namespace App\Services;

use App\Models\Laboratory;
use App\Services\Dto\LaboratoryDto;
use App\Services\Interfaces\LaboratoryServiceInterface;

Class LaboratoryService extends TransactionAbstractService implements LaboratoryServiceInterface {

    public function __construct(Laboratory $laboratory)
    {
        $this->model = $laboratory;
    }
    
    public function persist($dto) : Laboratory
    {
        $this->persistOptions($this->model, $dto->options);

        $this->persistRelation($this->model->addresses(), $dto->addresses);


        if($dto->comments) {
            $this->persistRelation($this->model->comments(), $dto->comments);
        }
        
        return  $this->model;
    }

} 