<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{
    protected $fillable = ['name','type'];

    const TYPES  = [
       'public',
       'private',
       'state',
       'veteran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function plots()
    {
        return $this->hasMany(Plot::class);    
    }

    public function coordinates()
    {
        return $this->morphOne(Coordinate::class, 'entity');
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class);
    }

    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'entity_options');
    }
}
