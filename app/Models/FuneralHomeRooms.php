<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuneralHomeRooms extends Model
{
    protected $fillable = ['name', 'capacity'];
    
    public function funeral_home()
    {
        return $this->belongsTo(FuneralHome::class);
    }
}
