<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class GuestSms extends Model
{
    public $timestamps=false;
    protected $fillable =[
        'created','expiration','phone',
        'code','device_mac','spot_id',
        'count_sessions','count_sms','last_sms'
    ];
}
