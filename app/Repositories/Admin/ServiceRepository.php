<?php

namespace App\Repositories\Admin;
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
        if($search = request('search')) {
            $this->model = $this->model->with(['options' => function($query) use ($search){
                $q = clone $query;

                $q->where('name', 'like', '%'.$search.'%');

                if($q->count() > 0) {
                    return $query->where('name', 'like', '%'.$search.'%');
                }
            }]);

            $this->model->when($search, function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')

                    ->orWhereHas('options', function( $query ) use ( $search ){
                        $query->where('name', 'like' ,'%'.$search.'%' ); //how to load only matches, no
                    });
            });
        }
        
        return $this->model->paginate(Service::POSTS_PER_PAGE);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 