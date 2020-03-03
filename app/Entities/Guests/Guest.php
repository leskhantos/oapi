<?php

namespace App\Entities\Guests;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public $timestamps = false;

    protected $fillable =[
        'datetime','spot_id',
        'company_id','spot_type',
        'device_mac','data_auth'
    ];
}
