<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $timestamps=false;

    public function spots(){
        $this->belongsTo(Spot::class);
    }
}
