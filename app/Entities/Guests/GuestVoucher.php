<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class GuestVoucher extends ParentGuest
{

    protected $fillable =[
        'activated','expiration','voucher_id',
        'device_mac','spot_id'
    ];
}
