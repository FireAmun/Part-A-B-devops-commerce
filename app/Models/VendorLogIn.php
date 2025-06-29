<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class VendorLogIn extends Authenticatable
{
    protected $table = 'vendor_log_in';

    protected $fillable = [
        'name',
        'password',
        'google2fa_secret',
        'vendor_id',
    ];

    protected $hidden = [
        'password',
        'google2fa_secret',
        'remember_token',
    ];

    /**
     * Get the vendor associated with this login.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    /**
     * Get the products for this vendor.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }
}
