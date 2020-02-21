<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'created', 'mac', 'type', 'os', 'os_version', 'screen_w', 'screen_h',
        'info', 'sessions', 'online', 'session', 'spot', 'comment', 'update'
    ];

    public function spots()
    {
        return $this->belongsTo(Spot::class);
    }

    public function countDevices()
    {
        $count_device = Device::count();

        return $count_device;
    }

    public function countDevicesForMonth()
    {
        $date = new \DateTime();
        $date = $date->format('m');
        $new_devices = Device::whereMonth('created','=',$date)->count();

        return $new_devices;
    }

    public function countAuthUser()
    {
        $new_devices = Device::where('sessions','>',0)->count();

        return $new_devices;
    }
}
