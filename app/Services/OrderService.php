<?php

namespace App\Services;

use App\Models\Order;
use App\Services\Dto\OrderDto;
use App\Services\Interfaces\OrderServiceInterface;

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