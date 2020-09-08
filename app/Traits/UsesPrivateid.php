<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait UsesPrivateid
{
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