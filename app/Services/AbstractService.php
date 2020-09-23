<?php
namespace App\Services;
use App\Models\Pivot\OptionAble;
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

    protected function persistOptions($entity, $options)
    {
        foreach($options as $option) {
             OptionAble::updateOrCreate(
                               [
                                 'service_options_id' => $option['option_id'],
                                 'optionable_type' => get_class($entity),
                                 'optionable_id' => $entity->id
                               ],
                               [
                                   'service_options_id' => $option['option_id'],
                                   'commission' => $option['commission'],
                                   'optionable_type' => get_class($entity),
                                   'optionable_id' => $entity->id
                               ]
                         );
            $optionAble = OptionAble::where('service_options_id', $option['option_id'])
                ->where( 'optionable_type' , get_class($entity))
                ->where('optionable_id', $entity->id)->first();

            if(isset($option['media'])) $optionAble->media()->sync($option['media'] ?? null);
        }

        return $entity;
    }

}