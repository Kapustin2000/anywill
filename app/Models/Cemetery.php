<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{
    const CLASSES  = [
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
}
