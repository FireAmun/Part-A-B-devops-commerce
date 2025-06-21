<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\VendorLogIn;

class VendorLogInSeeder extends Seeder
{
    public function run()
    {
        VendorLogIn::create([
            'name' => 'utmmart2@gmail.com',
            'password' => Hash::make('Utmcommerce1234'),
        ]);

        VendorLogIn::create([
            'name' => 'setepakprintingservicektf@gmail.com',
            'password' => Hash::make('Utmprinting1234'),
        ]);

        VendorLogIn::create([
            'name' => 'richiamocaffe@gmail.com',
            'password' => Hash::make('Caffeutm1234'),
        ]);
    }
}
