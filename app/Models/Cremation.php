<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cremation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coordinates()
    {
        return $this->morphOne(Coordinate::class, 'entity');
    } 
    
    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'entity_options');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'media_able');
    }
}
