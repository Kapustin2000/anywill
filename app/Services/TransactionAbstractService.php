<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;

abstract class TransactionAbstractService
{
    
    public function transaction($data, $entity = null)
    {
        return DB::transaction(function () use ($data, $entity){
            if($entity) {
                return $this->update($data, $entity);
            }

            return $this->save($data);
        });
    }
}