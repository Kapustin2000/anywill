<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'addressable',
        'administrative_area_level_1',
        'administrative_area_level_2',
        'country',
        'latitude',
        'longitude',
        'name',
        'locality',
        'place_id',
        'postal_code',
        'route',
        'street_number',
        'formatted_address'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
