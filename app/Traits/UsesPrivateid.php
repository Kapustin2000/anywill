<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait UsesPrivateid
{
    protected function getArrayableItems(array $values)
    {
        if(!in_array('id', $this->hidden)){
            $this->hidden[] = 'id';
        }
        return parent::getArrayableItems($values);
    }

    public function getRouteKeyName()
    {
        return 'private_id';
    }
    
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->private_id =  substr((string) Str::uuid(), 0, 5);
        });
    }
}