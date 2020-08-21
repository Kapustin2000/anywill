<?php

namespace App\Components;

use App\Models\Cemetery;
use App\Models\Cremation;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class MatchMaking {
    protected $order;
    protected $matches = [];
    protected $entities = [
      'cemetery' => 'App\Models\Cemetery',
      'cremation' => 'App\Models\Cremation',
      'funeral_home' => 'App\Models\FuneralHome',
      'laboratory' => 'App\Models\Laboratory'
    ];

    public function __construct(Order $order)
    {
        $this->order = json_decode($order->data, true);
        $this->matches['count_options'] = $order->count_options;
    }
    
    public function find()
    {
        foreach ($this->entities as $key=>$entity) {
            $this->searchMatching($key);
        }
        
        return $this->matches;
    }

    protected function searchMatching($entity = '')
    {
        if(isset($this->order[$entity])) {

            $model = resolve($this->entities[$entity]);

            $ids = array_column($this->order[$entity]['options'], 'option_id');
            $matching = $model::withCount(['options' => function($q) use ($ids) {
                $q->whereIn('id', $ids);
            }])->having('options_count', '>', 0)->orderByDesc('options_count')->with('options')->get();

            $this->matches[$entity] = $matching;
        }
    }
}