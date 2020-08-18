<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Services\Interfaces\CemeteryServiceInterface;

Class CemeteryService implements CemeteryServiceInterface {


    public function save(CemeteryRequest $request, Cemetery $cemetery = null) : Cemetery
    {
        if($cemetery) {
            $cemetery->save($request);
        }else {
          $cemetery =  Cemetery::create($request->all());
        }

        $cemetery->classifications()->sync($request->input('classifications'));

        $cemetery->coordinates()->updateOrCreate($request->input('coordinates'));

        //Maybe later
        //$cemetery->plots()->create($request->input('plots'));
        
        return $cemetery;
    }

} 