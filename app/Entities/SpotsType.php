<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SpotsType extends Model
{
    //

    public $timestamps=false;


    protected $fillable = [
        'name','code'
    ];

    public function spot()
    {
        return $this->hasMany(Spot::class);
    }
}
