<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    // Add these if you want to use $fillable instead:
    // protected $fillable = ['user_id', 'name', 'phone', 'vendor_id', 'cart', 'payment_proof', 'status'];

    protected $casts = [
        'products' => 'array',
    ];

    public function vendor()
    {
        return $this->belongsTo(\App\Models\Vendor::class, 'vendor_id');
    }
}
