<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StatsSms extends ParentStats
{
    protected $fillable = [
        'company_id','all','spot_id','date'
    ];
}
