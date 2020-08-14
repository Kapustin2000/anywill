<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public function services()
    {
        return $this->belongsToMany('App\Users')
            ->using('App\Pivots\Subscription');
    }
}
