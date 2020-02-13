<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SpotType extends Model
{
    //

    public $timestamps=false;


    protected $fillable = [
        'name'
    ];

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
}
