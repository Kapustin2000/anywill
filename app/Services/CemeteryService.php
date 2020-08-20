<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Services\Dto\CemeteryDto;
use App\Services\Interfaces\CemeteryServiceInterface;

Class CemeteryService implements CemeteryServiceInterface
{

    protected $cemetery;

    public function save(CemeteryDto $dto, Cemetery $cemetery = null) : Cemetery
    {
        
        if ($cemetery) {
            $cemetery->update($dto->data);
        } else {
            $cemetery = Cemetery::create($dto->data);
        }

        $cemetery->classifications()->sync($dto->classifications);

        $cemetery->coordinates()->updateOrCreate($dto->coordinates);

        $cemetery->options()->sync($dto->options);

        //Maybe later
        //$cemetery->plots()->create($request->input('plots'));

        return $cemetery;
    }

} 