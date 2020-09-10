<?php

namespace App\Repositories;
use App\Models\Service;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;


Class ServiceRepository implements RepositoryInterface, ServiceRepositoryInterface {

    protected $model;
    
    function __construct(Service $model)
    {
        $this->model = $model;
    }

    public function all()
    {
//        if($search = request('search')) {
//            $this->model = $this->model->with(['options' => function($query) use ($search){
//                $q = clone $query;
//
//                $q->where('name', 'like', '%'.$search.'%');
//
//                if($q->count() > 0) {
//                    return $query->where('name', 'like', '%'.$search.'%');
//                }
//            }]);
//
//            $this->model->when($search, function ($q) use ($search) {
//                $q->where('name', 'like', '%'.$search.'%')
//
//                    ->orWhereHas('options', function( $query ) use ( $search ){
//                        $query->where('name', 'like' ,'%'.$search.'%' ); //how to load only matches, no
//                    });
//            });
//        }

        $this->model->when(($entity_id = request('entity_id')) !== null, function ($q) use ($entity_id){
          return   $q->whereIn('entity_id', $entity_id);
        });

        $this->model->when(request('options') === null, function ($q){
            return $q->whereDoesntHave('dependencies');
        });

        $this->model->when(($options = request('options')) !== null, function ($q) use ($options){
            return $q->getWithDependencyCheck(array_column($options, 'option_id'));
        });


        $this->model->when(($ids = request('IDs')) !== null, function ($q) use ($ids){
           return $q->whereNotIn('id', $ids);
        });
        

        return $this->model->get();
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 