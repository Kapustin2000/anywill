<?php

namespace App\Models\Pivot;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class OptionAble extends MorphPivot
{
    protected $fillable = ['id', 'service_options_id', 'optionable_type', 'optionable_id', 'commissions'];
    protected $table = 'optionables';
    protected $with = ['media'];
    public $timestamps = false;
    protected $primaryKey = 'cst_id';

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }
}
