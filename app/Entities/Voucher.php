<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'spot_id', 'room', 'code', 'list_id', 'dt_start', 'dt_end', 'can_used'
    ];

    public function spots()
    {
        $this->belongsTo(Spot::class);
    }
}
