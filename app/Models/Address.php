<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'address'];

    public function addressable()
    {
        return $this->morphTo();
    }
}
