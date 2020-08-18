<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{
    const TYPES  = [
       'public' => 1,
       'private'  => 2,
       'state' => 3,
       'veteran' => 4
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
        return $this->belongsToMany(ServiceOptions::class);
    }
}
