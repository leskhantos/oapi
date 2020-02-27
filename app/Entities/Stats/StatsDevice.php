<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StatsDevice extends ParentStats
{
    protected $fillable = [
        'date', 'company_id', 'spot_id',
        'mobile', 'tablet', 'computer', 'type_other',
        'android', 'ios', 'linux', 'windows', 'windows_phone',
        'os_other', 'android_browser', 'edge', 'firefox', 'chrome',
        'opera', 'safari', 'yadex_browser', 'webkit', 'browser_other'
    ];
}
