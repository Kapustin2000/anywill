<?php
namespace App\Services\Interfaces;


use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Order;
use App\Services\Dto\CemeteryDto;
use App\Services\Dto\OrderDto;

interface OrderServiceInterface{
    public function save(OrderDto $data, Order $order = null) : Order;
}