<?php

namespace App\Repositories;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Services\Interfaces\CemeteryServiceInterface;



Class CemeteryRepository implements RepositoryInterface, CemeteryRepositoryInterface {

    protected $model;
    
    function __construct(Cemetery $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $this->model->when($search = request('search'), function ($q) use ($search) {
            return $q->where('private_id', 'like' , '%'.$search.'%')
                     ->orWhere('name', 'like' , '%'.$search.'%');
        });


        if(request('lng') && request('lat')) {
            $lat = request('lat');
            $lng = request('lng');

            $this->model->whereHas('address', function( $query ) use ( $lat, $lng ){
                $query->selectRaw(sqlDistance($lat, $lng))->havingRaw('distance < 20');
            });

            $this->model->with(['address' => function($q) use ($lat, $lng) {
                return $q->select('*')->selectRaw(sqlDistance($lat, $lng));
            }]);

        }else{
            $this->model->with('address');
        }

        return $this->model->paginate((int)request('per_page') ?? Cemetery::POSTS_PER_PAGE);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 