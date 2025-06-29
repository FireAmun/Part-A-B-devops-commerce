<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // UTM Mart Products (vendor_id = 1)
        Product::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'UTM Shirt',
                'slug' => 'utm-shirt',
                'thumb_image' => 'utm-shirt.jpeg',
                'vendor_id' => 1,
                'category_id' => 1,
                'brand_id' => 1,
                'qty' => 100,
                'short_description' => 'UTM branded shirt',
                'long_description' => 'Comfortable UTM branded shirt.',
                'price' => 25.00,
                'status' => 1,
            ]
        );

        Product::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'UTM Cup',
                'slug' => 'utm-cup',
                'thumb_image' => 'utm-cup.jpeg',
                'vendor_id' => 1,
                'category_id' => 2,
                'brand_id' => 1,
                'qty' => 100,
                'short_description' => 'UTM branded cup',
                'long_description' => 'Ceramic cup with UTM logo.',
                'price' => 15.00,
                'status' => 1,
            ]
        );

        Product::updateOrCreate(
            ['id' => 3],
            [
                'name' => 'UTM Books',
                'slug' => 'utm-books',
                'thumb_image' => 'utm-books.jpeg',
                'vendor_id' => 1,
                'category_id' => 3,
                'brand_id' => 1,
                'qty' => 100,
                'short_description' => 'UTM books',
                'long_description' => 'Books for UTM students.',
                'price' => 40.00,
                'status' => 1,
            ]
        );

        // Richiamo Caffe Products (vendor_id = 2)
        $richiamoProducts = [
            // Hot Beverages
            ['id' => 10, 'name' => 'Espresso', 'price' => 7.90],
            ['id' => 11, 'name' => 'Double Espresso', 'price' => 9.50],
            ['id' => 12, 'name' => 'Hot Americano', 'price' => 9.40],
            ['id' => 13, 'name' => 'Hot Cappuccino', 'price' => 10.70],
            ['id' => 14, 'name' => 'Hot Caramello Cappuccino', 'price' => 12.20],
            ['id' => 15, 'name' => 'Hot Hazelnut Cappuccino', 'price' => 12.20],
            // Cold Beverages
            ['id' => 40, 'name' => 'Iced Americano', 'price' => 12.10],
            ['id' => 41, 'name' => 'Iced White Mochaccino', 'price' => 13.40],
            ['id' => 42, 'name' => 'Iced Cappuccino', 'price' => 12.10],
        ];

        foreach ($richiamoProducts as $product) {
            Product::updateOrCreate(
                ['id' => $product['id']],
                [
                    'name' => $product['name'],
                    'slug' => strtolower(str_replace(' ', '-', $product['name'])),
                    'thumb_image' => 'product-default.jpg',
                    'vendor_id' => 2,
                    'category_id' => 4, // Beverages category
                    'brand_id' => 2, // Richiamo brand
                    'qty' => 100,
                    'price' => $product['price'],
                    'short_description' => $product['name'] . ' from Richiamo',
                    'long_description' => 'Delicious ' . $product['name'] . ' from Richiamo Caffe.',
                    'status' => 1,
                ]
            );
        }

        // Setepak Printing Products (vendor_id = 3)
        $printingProducts = [
            ['id' => 60, 'name' => 'A4 Black & White Prints', 'price' => 1.00],
            ['id' => 61, 'name' => 'A4 Color Prints', 'price' => 5.00],
            ['id' => 62, 'name' => 'A3 Black & White Prints', 'price' => 3.00],
            ['id' => 63, 'name' => 'A3 Color Prints', 'price' => 10.00],
            ['id' => 67, 'name' => 'Business Cards - Premium Set', 'price' => 100.00],
            ['id' => 68, 'name' => 'Small Banner', 'price' => 30.00],
        ];

        foreach ($printingProducts as $product) {
            Product::updateOrCreate(
                ['id' => $product['id']],
                [
                    'name' => $product['name'],
                    'slug' => strtolower(str_replace(' ', '-', $product['name'])),
                    'thumb_image' => 'product-default.jpg',
                    'vendor_id' => 3,
                    'category_id' => 5, // Printing category
                    'brand_id' => 3, // Setepak brand
                    'qty' => 500,
                    'price' => $product['price'],
                    'short_description' => $product['name'] . ' from Setepak Printing',
                    'long_description' => 'Professional ' . $product['name'] . ' from Setepak Printing Services.',
                    'status' => 1,
                ]
            );
        }
    }
}
