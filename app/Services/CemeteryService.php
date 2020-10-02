<?php

namespace App\Services;

use App\Models\Cemetery;
use App\Services\Dto\AbstractDto;
use App\Services\Dto\CemeteryDto;
use App\Services\Interfaces\CemeteryServiceInterface;

Class CemeteryService extends AbstractService implements CemeteryServiceInterface
{

    public function __construct(Cemetery $cemetery)
    {
        $this->model = $cemetery;
    }

    public function persist($dto) : Cemetery
    {
        $this->model->classifications()->sync($dto->classifications);

//        $this->cemetery->coordinates()->updateOrCreate($dto->coordinates);

        $this->persistOptions($this->model, $dto->options);

        $this->model->managers()->sync($dto->managers);

        $this->model->media()->sync($dto->media);

        if($dto->address) $this->model->address()->updateOrCreate($dto->address);
        //Maybe later
        //$cemetery->plots()->create($request->input('plots'));

        return $this->model;
    }

} 