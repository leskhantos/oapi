<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Radius extends Model
{
    protected $connection = 'radius';
    protected $table = 'radcheck';

    public $timestamps = false;

    protected $fillable = [
        'username', 'attribute', 'op', 'value'
    ];
}
