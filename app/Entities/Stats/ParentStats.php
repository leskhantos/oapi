<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ParentStats extends Model
{

    public $timestamps=false;

    public function companies(){
        return $this->belongsTo(Company::class);
    }

    public function spots(){
        return $this->hasMany(Spot::class,'spot_id','id');
    }
}
