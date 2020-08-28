<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Order;
use App\Models\Service;
use App\Services\Dto\OrderDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;

Class OrderService extends TransactionAbstractService implements  OrderServiceInterface{
    
    public function save(OrderDto $dto, Order $order = null)  : Order
    {
        if($order) {
            $order->save($dto->order);
        }else {
            $order = Order::create($dto->order);
        }
        
        return $order;
    }
}