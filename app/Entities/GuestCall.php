<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class GuestCall extends Model
{
    public $timestamps=false;
    protected $fillable =[
        'created','expiration','phone',
        'device_mac','spot_id'
    ];
}
