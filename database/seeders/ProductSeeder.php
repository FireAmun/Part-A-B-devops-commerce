<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'UTM Shirt',
            'slug' => 'utm-shirt',
            'thumb_image' => 'utm-shirt.jpeg', // Place this file in public/images/
            'vendor_id' => 1,
            'category_id' => 1,
            'brand_id' => 1,
            'qty' => 100,
            'short_description' => 'UTM branded shirt',
            'long_description' => 'Comfortable UTM branded shirt.',
            'price' => 25.00,
            'status' => 1,
        ]);
        Product::create([
            'name' => 'UTM Cup',
            'slug' => 'utm-cup',
            'thumb_image' => 'utm-cup.jpeg', // Place this file in public/images/
            'vendor_id' => 1,
            'category_id' => 2,
            'brand_id' => 1,
            'qty' => 100,
            'short_description' => 'UTM branded cup',
            'long_description' => 'Ceramic cup with UTM logo.',
            'price' => 15.00,
            'status' => 1,
        ]);
        Product::create([
            'name' => 'UTM Books',
            'slug' => 'utm-books',
            'thumb_image' => 'utm-books.jpeg', // Place this file in public/images/
            'vendor_id' => 1,
            'category_id' => 3,
            'brand_id' => 1,
            'qty' => 100,
            'short_description' => 'UTM books',
            'long_description' => 'Books for UTM students.',
            'price' => 40.00,
            'status' => 1,
        ]);
    }
}
