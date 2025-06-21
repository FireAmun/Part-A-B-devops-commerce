<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'thumb_image', 'vendor_id', 'category_id', 'brand_id', 'qty',
        'short_description', 'long_description', 'video_link', 'sku', 'price', 'offer_price',
        'offer_start_date', 'offer_end_date', 'product_type', 'status', 'is_approved',
        'seo_title', 'seo_description'
    ];

    // Add the missing relationships
    public function vendor()
    {
        return $this->belongsTo(VendorLogIn::class, 'vendor_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
