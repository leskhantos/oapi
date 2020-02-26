<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StatsGuest extends ParentStats
{
    protected $fillable = [
        'date','company_id','load','auth','new','old'
    ];
}
