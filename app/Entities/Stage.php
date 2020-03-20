<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'created', 'spot_id', 'device_mac', 'phone'
    ];

    public function spots()
    {
        $this->belongsTo(Spot::class);
    }
}
