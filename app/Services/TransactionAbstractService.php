<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
abstract class TransactionAbstractService
{
    
    public function transaction($data, $entity)
    {
        return DB::transaction(function () use ($data, $entity){
            if($entity) {
                return $this->update($data, $entity);
            }

            return $this->save($data);
        });
    }
}