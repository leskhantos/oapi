<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SessionsSpot extends Model
{
    protected $fillable = [
        'spot_id', 'username', 'device_mac', 'stop',
        'bytes_in', 'bytes_out', 'start', 'active'
    ];

    protected $casts = [
        'created' => 'datetime:d-m-Y H:m:s',
    ];

    public $timestamps = false;

    public function spots()
    {
        return $this->belongsTo(Spot::class);
    }
}
