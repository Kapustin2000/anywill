<?php

namespace App\Components;

use App\Models\Cemetery;
use App\Models\Order;

class MatchMaking {
    
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    
    public function find()
    {
        
    }
}