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
     * Get the vendor login information associated with this vendor.
     */
    public function vendorLogin()
    {
        return $this->belongsTo(VendorLogIn::class, 'vendor_id', 'id');
    }

    /**
     * Get the products sold by this vendor.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the orders associated with this vendor.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
