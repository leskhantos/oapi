<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Guest extends ParentGuest
{
    protected $fillable = ['datetime','company_id','spot_id','device_mac','data_auth'];
}
