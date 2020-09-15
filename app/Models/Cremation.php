<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Cremation extends Model
{
    use UsesPrivateid;

    const POSTS_PER_PAGE = 15;
    
    protected $fillable = ['user_id', 'description', 'name'];

    public function owner()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coordinates()
    {
        return $this->morphOne(Coordinate::class, 'entity');
    } 
    
    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'optionable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function managers()
    {
        return $this->morphedByMany(Manager::class, 'manageable');
    }
}
