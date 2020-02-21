<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ParentSession extends Model
{
    public $timestamps = false;

    public function spots()
    {
        return $this->belongsTo(Spot::class);
    }
}
