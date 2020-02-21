<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Monolog\Formatter\JsonFormatter;

class Spot extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'company_id', 'address', 'type', 'ident',
        'last_activity', 'settings','page_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function spotType()
    {
        return $this->hasMany(SpotsType::class, 'spot_id', 'id');
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'spot_id', 'id');
    }

    public function stats()
    {
        return $this->hasMany(ParentStats::class, 'spot_id', 'id');
    }

    public function guests()
    {
        return $this->hasMany(ParentGuest::class, 'spot_id', 'id');
    }

    public function session()
    {
        return $this->hasMany(ParentSession::class, 'spot_id', 'id');
    }

    public function stages()
    {
        return $this->hasMany(Stage::class, 'spot_id', 'id');
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'spot_id', 'id');
    }

    public function countCompanies()
    {
        $companies = Spot::withCount('company')->get();

        foreach ($companies as $company) {
            $count_company = $company->company_count;
        }
        return $count_company;
    }

    public function countDevices()
    {
        $devices = Spot::withCount('devices')->get();

        foreach ($devices as $device){
            $count_device = $device->devices_count;
        }
        return $count_device;
    }

    public function countDevicesForMonth()
    {
        $date = new \DateTime();
        $date = $date->format('m');
        $new_devices = Device::whereMonth('created','=',$date)->count();

        return $new_devices;
    }

}
