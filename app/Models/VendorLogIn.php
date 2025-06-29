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
    ];

    protected $hidden = [
        'password',
        'google2fa_secret',
        'remember_token',
    ];

    /**
     * Get the vendor details associated with this vendor login.
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    /**
     * Get the products associated with this vendor.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }
}
