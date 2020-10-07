<?php

namespace App\Services;


use App\Models\Cremation;
use App\Services\Dto\CremationDto;
use App\Services\Interfaces\CremationServiceInterface;

Class CremationService extends TransactionAbstractService implements  CremationServiceInterface
{

    public function __construct(Cremation $cremation)
    {
        $this->model = $cremation;
    }


    public function persist($dto) : Cremation
    { 
        $this->persistOptions($this->model, $dto->options);

        $this->persistRelation($this->model->addresses(), $dto->addresses);

        if($dto->comments) {
            $this->persistRelation($this->model->comments(), $dto->comments);
        }

        return $this->model->load($this->model->with);
    }

} 