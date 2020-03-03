<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Monolog\Formatter\JsonFormatter;

class Spot extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'company_id', 'address', 'type', 'ident',
        'last_activity', 'settings', 'page_id','enabled'
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

    public function session_spots()
    {
        return $this->hasMany(SessionsAuth::class, 'spot_id', 'id');
    }

    public function session_auth()
    {
        return $this->hasMany(SessionsSpot::class, 'spot_id', 'id');
    }

    public function stages()
    {
        return $this->hasMany(Stage::class, 'spot_id', 'id');
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'spot_id', 'id');
    }
}
