<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment'];
    protected $hidden = ['owner_type', 'owner_id'];
    
    public function owner()
    {
        return $this->morphTo();
    }
}
