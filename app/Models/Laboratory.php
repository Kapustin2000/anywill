<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use UsesUuid;
    
    protected $fillable = ['name'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'entity_options');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'media_able');
    }
}
