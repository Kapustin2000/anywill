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

    protected function updateRelation($relation, $data, $match = null) {
        $needsUpdate = array_column($data, 'id');

        foreach($data as $item) {
            $relation->updateOrCreate(['id' => $item[$match] ?? null], $item);
        }
        
        return $relation->whereNotIn('id', $needsUpdate)->delete();
    }
}