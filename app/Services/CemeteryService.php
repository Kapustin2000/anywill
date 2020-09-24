<?php

namespace App\Services;

use App\Models\Cemetery;
use App\Services\Dto\CemeteryDto;
use App\Services\Interfaces\CemeteryServiceInterface;

Class CemeteryService extends AbstractService implements CemeteryServiceInterface
{

    protected $cemetery;

    public function save(CemeteryDto $dto) : Cemetery
    {
        $this->cemetery = $cemetery = Cemetery::create($dto->data);

        return $this->persistCemetery($dto);
    }

    public function update(CemeteryDto $dto, Cemetery $cemetery) : Cemetery
    {
        $this->cemetery = $cemetery->update($dto->data);

        return $this->persistCemetery($dto);
    }

    protected function persistCemetery(CemeteryDto $dto) : Cemetery
    {
        $this->cemetery->classifications()->sync($dto->classifications);

//        $this->cemetery->coordinates()->updateOrCreate($dto->coordinates);

        $this->persistOptions($this->cemetery, $dto->options);

        $this->cemetery->managers()->sync($dto->managers);

        $this->cemetery->media()->sync($dto->media);

        //Maybe later
        //$cemetery->plots()->create($request->input('plots'));

        return $this->cemetery;
    }

} 