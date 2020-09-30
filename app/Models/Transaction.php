<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use UsesPrivateid;

    protected $casts = [
        'details' => 'array'
    ];

    const TYPES = [
        'replenishment',
        'transfer',
        'output'
    ];

    const PROVIDERS = [
       'other',
       'stripe',
       'manual',
       'bank'
    ];
    
    protected $fillable = ['from_user_id', 'to_user_id', 'size','provider','type', 'details'];
    
    public function user()
    {
        return $this->belongsTo(Transaction::class);
    }
    
    public function type()
    {
        return $this->belongsTo(TransactionType::class);
    }
}
