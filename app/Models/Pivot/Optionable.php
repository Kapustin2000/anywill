<?php

namespace App\Models\Pivot;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class OptionAble extends MorphPivot
{
    protected $table = 'optioables';
    protected $with = ['media'];

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }
}
