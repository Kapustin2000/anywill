<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOptions extends Model
{
    protected $with = ['options', 'services'];
    protected $table = 'service_options';
    protected $hidden = ['pivot'];
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'service_id', 'meta_data_id', 'input_type_id'];

    public function optionable()
    {
        return $this->morphTo();
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function services()
    {
        return $this->belongsToMany(Service::class, 'option_services', 'option_id', 'service_id');
    }

    public function parent() {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function options() {
        return $this->hasMany(static::class, 'parent_id');
    }
    
    public function meta() {
        return $this->belongsTo(MetaData::class, 'meta_data_id');
    }
}
