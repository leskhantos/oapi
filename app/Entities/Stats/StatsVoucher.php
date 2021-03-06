<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StatsVoucher extends ParentStats
{
    protected $fillable = [
        'date', 'company_id', 'spot_id', 'all', 'auth'
    ];

    protected $casts = [
        'date' => 'datetime:d-m-Y H:m:s',
    ];
}
