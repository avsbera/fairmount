<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RazorpayTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'paid_for_id',
        'paid_for_type',
        'order_id',
        'payment_id',
        'gateway',
        'body',
        'destination',
        'signature',
        'response',
        'status',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    
}