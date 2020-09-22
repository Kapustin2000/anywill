<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];

    public function permissionable()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
