<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StatsCall extends ParentStats
{
    protected $fillable = [
        'date', 'company_id', 'spot_id',
        'requests', 'checked'
    ];

    protected $casts = [
        'date' => 'datetime:d-m-Y H:m:s',
    ];
}
