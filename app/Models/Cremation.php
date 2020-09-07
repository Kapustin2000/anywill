<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Cremation extends Model
{
    use UsesUuid;
    
    protected $fillable = ['user_id', 'description', 'name'];
    
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
        return $this->morphTo(Address::class, 'addressable');
    }
}
