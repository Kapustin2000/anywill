<?php

namespace App\Services;

use App\Models\FuneralHome;
use App\Services\Dto\FuneralHomeDto;;
use App\Services\Interfaces\FuneralHomeServiceInterface;

Class FuneralHomeService extends AbstractService implements FuneralHomeServiceInterface
{
    public function __construct(FuneralHome $home)
    {
        $this->model = $home;
    }

    public function persist($dto) : FuneralHome
    {
        $this->persistOptions($this->model, $dto->options);
        $this->persistRelation($this->model->addresses(), $dto->addresses);
        $this->persistRelation($this->model->rooms(), $dto->rooms);

        if($dto->comments) {
            $this->persistRelation($this->model->comments(), $dto->comments);
        }

        return $this->model;
    }

} 