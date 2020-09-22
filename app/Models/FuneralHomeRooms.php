<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuneralHomeRooms extends Model
{
    protected $fillable = ['name', 'description', 'capacity'];
    
    public function funeral_home()
    {
        return $this->belongsTo(FuneralHome::class);
    }

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }
}
