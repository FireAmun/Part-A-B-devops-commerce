<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin
        Admin::updateOrCreate(
            ['email' => 'utmcommerceconnect@gmail.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
            ]
        );

        // Create Regular Admin
        Admin::updateOrCreate(
            ['email' => 'admin@utm.my'],
            [
                'name' => 'Regular Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
