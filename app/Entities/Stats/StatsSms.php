<?php

namespace App\Entities;


class StatsSms extends ParentStats
{
    protected $fillable = [
        'company_id', 'all', 'spot_id', 'date', 'resend', 'delivered'
    ];

    protected $casts = [
        'date' => 'datetime:d-m-Y H:m:s',
    ];
}
