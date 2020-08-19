<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Services\Interfaces\CemeteryServiceInterface;

Class CemeteryService implements CemeteryServiceInterface
{

    protected $cemetery;

    public function save(CemeteryRequest $request, Cemetery $cemetery = null) : Cemetery
    {
        
        if ($cemetery) {
            $cemetery->update($request->all());
        } else {
            $cemetery = Cemetery::create($request->all());
        }

        $cemetery->classifications()->sync($request->input('classifications'));

        $cemetery->coordinates()->updateOrCreate(['coordinates' => json_encode($request->input('coordinates'))]);

        $cemetery->options()->sync($request->input('options'));

        //Maybe later
        //$cemetery->plots()->create($request->input('plots'));

        return $cemetery;
    }

} 