<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ParentGuest extends Model
{
    public $timestamps=false;

    public function spots(){
        return $this->belongsTo(Spot::class);
    }
}
