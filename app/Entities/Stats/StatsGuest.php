<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StatsGuest extends ParentStats
{
    protected $fillable = [
        'date','company_id','spot_id','load','auth','new','old'
    ];

    protected $casts = [
        'date' => 'datetime:d-m-Y H:m:s',
    ];
}
