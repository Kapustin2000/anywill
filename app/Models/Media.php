<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['path'];
    protected $hidden = ['media_able_type', 'media_able_id'];
    
    public function media_able()
    {
        return $this->morphTo();
    }
}
