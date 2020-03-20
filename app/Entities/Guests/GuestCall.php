<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class GuestCall extends ParentGuest
{

    protected $fillable =[
        'expiration','phone', 'device_mac','spot_id','checked'
    ];
}
