<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOptions extends Model
{
    protected $with = ['parent', 'children'];
    protected $table = 'service_options';
    protected $hidden = ['pivot'];
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'meta_data_id', 'input_type_id'];

    public function optionable()
    {
        return $this->morphTo();
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    


    public function parent() {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(static::class, 'parent_id');
    }
    
    public function meta() {
        return $this->belongsTo(MetaData::class, 'meta_data_id');
    }
}
