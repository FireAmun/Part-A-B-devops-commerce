<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class RichiamoProductSeeder extends Seeder
{
    public function run()
    {
        // Hot Beverages
        $hotBeverages = [
            ['name' => 'Espresso', 'price' => 7.90],
            ['name' => 'Double Espresso', 'price' => 9.50],
            ['name' => 'Hot Americano', 'price' => 9.40],
            ['name' => 'Hot Cappuccino', 'price' => 10.70],
            ['name' => 'Hot Caramello Cappuccino', 'price' => 12.20],
            ['name' => 'Hot Hazelnut Cappuccino', 'price' => 12.20],
            ['name' => 'Hot Caffe Latte', 'price' => 10.70],
            ['name' => 'Hot Caramello Latte', 'price' => 12.20],
            ['name' => 'Hot Hazelnut Latte', 'price' => 12.20],
            ['name' => 'Hot Salted Caramello Latte', 'price' => 12.20],
            ['name' => 'Hot White Mochaccino', 'price' => 12.20],
            ['name' => 'Hot Caffe Vanilla', 'price' => 12.20],
            ['name' => 'Hot Chocolate', 'price' => 10.70],
            ['name' => 'Hot Vanilla Chocolate', 'price' => 12.20],
            ['name' => 'Hot Caramello Chocolate', 'price' => 12.20],
            ['name' => 'Hot Hazelnut Chocolate', 'price' => 12.20],
            ['name' => 'Hot Matcha Latte', 'price' => 10.80],
            ['name' => 'Hot Caffe Matcha Latte', 'price' => 11.50],
            ['name' => 'Hot Teh Tarik Premium', 'price' => 9.40],
            ['name' => 'Hot Fresh Lemon Tea', 'price' => 8.10],
            ['name' => 'Hot Fresh Apple Tea', 'price' => 8.10],
            ['name' => 'Hot English Breakfast Tea', 'price' => 5.40],
            ['name' => 'Hot Earl Grey Tea', 'price' => 5.40],
        ];

        foreach ($hotBeverages as $item) {
            Product::create([
                'name' => $item['name'],
                'slug' => str_replace(' ', '-', strtolower($item['name'])),
                'thumb_image' => str_replace(' ', '-', strtolower($item['name'])) . '.png',
                'vendor_id' => 3,
                'category_id' => 4, // Hot Beverages category
                'brand_id' => 2, // Richiamo brand
                'qty' => 100,
                'short_description' => $item['name'] . ' from Richiamo Caffe',
                'long_description' => 'Premium quality ' . $item['name'] . ' served at Richiamo Caffe.',
                'price' => $item['price'],
                'status' => 1,
            ]);
        }

        // Cold Beverages
        $coldBeverages = [
            ['name' => 'Iced Americano', 'price' => 12.10],
            ['name' => 'Iced White Mochaccino', 'price' => 13.40],
            ['name' => 'Iced Cappuccino', 'price' => 12.10],
            ['name' => 'Iced Caramello Cappuccino', 'price' => 13.40],
            ['name' => 'Iced Hazelnut Cappuccino', 'price' => 13.40],
            ['name' => 'Iced Caffe Latte', 'price' => 12.10],
            ['name' => 'Iced Caramello Latte', 'price' => 13.40],
            ['name' => 'Iced Hazelnut Latte', 'price' => 13.40],
            ['name' => 'Iced Vanilla Latte', 'price' => 13.40],
            ['name' => 'Iced Chocolate', 'price' => 12.10],
            ['name' => 'Iced Classy Dark Chocolate', 'price' => 13.40],
            ['name' => 'Iced Vanilla Chocolate', 'price' => 13.40],
            ['name' => 'Iced Caramello Chocolate', 'price' => 13.40],
            ['name' => 'Iced Hazelnut Chocolate', 'price' => 13.40],
            ['name' => 'Iced Matcha Latte', 'price' => 13.40],
            ['name' => 'Iced Caffe Matcha Latte', 'price' => 14.20],
            ['name' => 'Iced Teh Tarik Premium', 'price' => 12.10],
            ['name' => 'Iced Fresh Lemon Tea', 'price' => 10.70],
            ['name' => 'Iced Fresh Apple Tea', 'price' => 10.70],
            ['name' => 'Fresh Milk Brown Sugar Boba', 'price' => 13.40],
        ];

        foreach ($coldBeverages as $item) {
            Product::create([
                'name' => $item['name'],
                'slug' => str_replace(' ', '-', strtolower($item['name'])),
                'thumb_image' => str_replace(' ', '-', strtolower($item['name'])) . '.png',
                'vendor_id' => 3,
                'category_id' => 5, // Cold Beverages category
                'brand_id' => 2, // Richiamo brand
                'qty' => 100,
                'short_description' => $item['name'] . ' from Richiamo Caffe',
                'long_description' => 'Refreshing ' . $item['name'] . ' served cold at Richiamo Caffe.',
                'price' => $item['price'],
                'status' => 1,
            ]);
        }

        // Smoothies
        $smoothies = [
            ['name' => 'Strawberry Smoothies', 'price' => 8.00],
            ['name' => 'Lemonade Smoothies', 'price' => 8.00],
            ['name' => 'Kiwi Smoothies', 'price' => 8.00],
            ['name' => 'Orange Smoothies', 'price' => 8.00],
            ['name' => 'Mango Smoothies', 'price' => 8.00],
        ];

        foreach ($smoothies as $item) {
            Product::create([
                'name' => $item['name'],
                'slug' => str_replace(' ', '-', strtolower($item['name'])),
                'thumb_image' => str_replace(' ', '-', strtolower($item['name'])) . '.png',
                'vendor_id' => 3,
                'category_id' => 6, // Smoothies category
                'brand_id' => 2, // Richiamo brand
                'qty' => 100,
                'short_description' => $item['name'] . ' from Richiamo Caffe',
                'long_description' => 'Fresh and healthy ' . $item['name'] . ' made with real fruits.',
                'price' => $item['price'],
                'status' => 1,
            ]);
        }

        // Food
        $food = [
            ['name' => 'Nasi Lemak Biasa', 'price' => 6.70],
            ['name' => 'Nasi Lemak Ayam Rendang', 'price' => 20.20],
            ['name' => 'Nasi Lemak Daging Rendang', 'price' => 20.20],
            ['name' => 'Nasi Ayam Masak Lemak Cili Padi', 'price' => 20.20],
            ['name' => 'Chicken Bolognese', 'price' => 16.10],
            ['name' => 'Beef Bolognese', 'price' => 16.10],
            ['name' => 'Salted Egg Prawn', 'price' => 26.90],
        ];

        foreach ($food as $item) {
            Product::create([
                'name' => $item['name'],
                'slug' => str_replace(' ', '-', strtolower($item['name'])),
                'thumb_image' => str_replace(' ', '-', strtolower($item['name'])) . '.png',
                'vendor_id' => 3,
                'category_id' => 7, // Food category
                'brand_id' => 2, // Richiamo brand
                'qty' => 30,
                'short_description' => $item['name'] . ' from Richiamo Caffe',
                'long_description' => 'Delicious ' . $item['name'] . ' prepared fresh at Richiamo Caffe.',
                'price' => $item['price'],
                'status' => 1,
            ]);
        }
    }
}
