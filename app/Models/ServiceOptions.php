<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOptions extends Model
{
    protected $table = 'service_options';

    protected $fillable = ['name'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
