<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class DefaultSetting extends Model
{
    public $timestamps=false;
    protected $fillable =[
        'datetime','owner','redirect_url','session_auto_timer',
        'session_timer','wait_enter_timer','sms_phone_limit',
        'sms_device_limit','sms_life_timer','sms_allow_country',
        'call_wait_timer','call_allow_country','enable_monitoring',
        'alert_monitoring_timer'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
