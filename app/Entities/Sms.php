<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'uid', 'spot_ident', 'spot_id', 'phone',
        'device_mac', 'message', 'dt_request', 'dt_check',
        'dt_send', 'country', 'region', 'operator', 'price',
        'sender', 'status_code', 'status_text', 'status'
    ];
}
