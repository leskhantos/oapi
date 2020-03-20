<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SessionsAuth extends Model
{
    protected $fillable = [
        'spot_id', 'expiration', 'used', 'device_mac', 'signature', 'counter'
    ];

    protected $casts = [
        'created' => 'datetime:d-m-Y H:m:s',
        'expiration' => 'datetime:d-m-Y H:m:s'
    ];

    public $timestamps = false;

    public function spots()
    {
        return $this->belongsTo(Spot::class);
    }

    public function sessionAuth()
    {
        $date = new \DateTime();
        return SessionsAuth::where('expiration', '>', $date)->count();
    }
}
