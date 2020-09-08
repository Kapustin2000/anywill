<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class Cremation extends Model
{
    use UsesPrivateid;
    
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
        return $this->morphToMany(ServiceOptions::class, 'entity_options');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
