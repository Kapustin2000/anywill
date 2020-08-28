<?php

namespace App\Http\Controllers;

use App\Components\MatchMaking;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderMatchingController extends Controller
{

    public function __invoke(Order $order)
    {
       $matching = new MatchMaking($order);

       return  $matching->find();
    }
}
