<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;

abstract class AbstractService extends TransactionAbstractService
{
    protected function persistRelation($relation, $data, $key = 'id')
    {
           if($data) {
               $needsUpdate = array_column($data, $key);

               $relation->whereNotIn($key, $needsUpdate)->delete();

               foreach($data as $object) {
                   $relation->updateOrCreate([$key => $object[$key] ?? null], $object);
               }
           }
    }

}