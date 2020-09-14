<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use UsesPrivateid;

    const POSTS_PER_PAGE = 15;


    protected $fillable = ['name', 'description'];

    public function owner()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'entity_options');
    }

    public function address()
    {
        return $this->morphTo(Address::class, 'addressable');
    }

    public function managers()
    {
        return $this->morphToMany(Manager::class, 'manageable');
    }
}
