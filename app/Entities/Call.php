<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    //
    public $timestamps=false;

    protected $fillable = [
        'phone','datetime'
    ];
}
