<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
abstract class TransactionAbstractService
{
    
    public function transaction($data)
    {
        return DB::transaction(function () use ($data){
            return $this->save($data);
        });
    }
}