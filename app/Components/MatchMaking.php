<?php

namespace App\Components;

use App\Models\Cemetery;
use App\Models\Cremation;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class MatchMaking {
    protected $order;
    protected $matches = [];

    public function __construct(Order $order)
    {
        $this->order = json_decode($order->data, true);
        $this->matches['count_options'] = $order->count_options;
    }
    
    public function find()
    {
        foreach (config('entities') as $entity) {
            $this->searchMatching($entity);
        }
        
        return $this->matches;
    }

    protected function searchMatching($entity = '')
    {
        if(isset($this->order[$entity])) {

            $model = resolve('App\Models\\'.ucfirst(trans($entity)));

            $ids = array_column($this->order[$entity]['options'], 'id');
            $matching = $model::withCount(['options' => function($q) use ($ids) {
                $q->whereIn('id', $ids);
            }])->having('options_count', '>', 0)->orderByDesc('options_count')->with('options')->get();

            $this->matches[$entity] = $matching;
        }
    }
}