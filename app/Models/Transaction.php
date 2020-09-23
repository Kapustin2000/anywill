<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'type', 'details'];
    
    public function user()
    {
        return $this->belongsTo(Transaction::class);
    }
    
    public function type()
    {
        return $this->belongsTo(TransactionType::class);
    }
}
