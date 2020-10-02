<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use UsesPrivateid;
    
    protected $fillable = ['data', 'description', 'count_options', 'display_wishes_field', 'wishes'];

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }
}
