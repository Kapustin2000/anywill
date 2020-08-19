<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $hidden = ['pivot'];
    
    public function cemeteries()
    {
        return $this->belongsToMany(Cemetery::class);
    }
}
