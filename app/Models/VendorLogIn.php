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
}
