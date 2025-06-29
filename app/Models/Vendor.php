<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'description',
        'fb_link',
        'status',
    ];

    /**
     * Get the vendor login associated with this vendor.
     */
    public function login()
    {
        return $this->hasOne(VendorLogIn::class, 'vendor_id');
    }

    /**
     * Get the products for this vendor.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the orders for this vendor.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
