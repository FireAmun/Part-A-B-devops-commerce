<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    public function run()
    {
        DB::table('vendors')->insert([
            [
                'id' => 1,
                'name' => 'UTM Mart',
                'banner' => 'utm-mart.jpg',
                'phone' => '0123456789',
                'email' => 'utmmart@example.com',
                'address' => 'UTM Skudai, Johor',
                'description' => 'Your campus convenience store with a wide range of products.',
                'fb_link' => null,
                'tw_link' => null,
                'insta_link' => null,
                'user_id' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Setepak Printing Service KTF',
                'banner' => 'setepak-printing.jpg',
                'phone' => '0198765432',
                'email' => 'setepak@example.com',
                'address' => 'KTF, UTM Skudai',
                'description' => 'Professional printing services for all your academic needs.',
                'fb_link' => null,
                'tw_link' => null,
                'insta_link' => null,
                'user_id' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Richiamo Coffee',
                'banner' => 'richiamo-coffee.jpg',
                'phone' => '0171234567',
                'email' => 'richiamo@example.com',
                'address' => 'UTM Library, Skudai',
                'description' => 'Premium coffee and delicious treats for your study breaks.',
                'fb_link' => null,
                'tw_link' => null,
                'insta_link' => null,
                'user_id' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
