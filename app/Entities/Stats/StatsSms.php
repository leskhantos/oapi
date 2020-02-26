<?php

namespace App\Entities;


class StatsSms extends ParentStats
{
    protected $fillable = [
        'company_id','all','spot_id','date','resend','delivered'
    ];
}
