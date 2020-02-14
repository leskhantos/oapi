<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $timestamps=false;
    protected $fillable =[
        'spot_id','room','code',
        'dt_start','dt_end','can_used'
    ];
}
