<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plot extends Model
{
    protected $fillable = ['square_meters', 'description'];
    
    use SoftDeletes;

    public function cemetery()
    {
        return $this->belongsTo(Cemetery::class);
    }

    public function types()
    {
        return $this->belongsToMany(PlotTypes::class, 'plot_type');
    }
}
