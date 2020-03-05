<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SessionsAuth extends Model
{
    protected $fillable =[
        'spot_id','created','expiration',
        'used','device_mac','signature',
        'counter'
    ];

    public $timestamps = false;

    public function spots()
    {
        return $this->belongsTo(Spot::class);
    }

    public function sessionAuth()
    {
        $date = new \DateTime();
        return SessionsAuth::where('expiration','>',$date)->count();
    }
}
