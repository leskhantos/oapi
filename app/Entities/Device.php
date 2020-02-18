<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    public $timestamps=false;

    protected $fillable =[
        'created','mac','type','os','os_version','screen_w','screen_h',
        'info','sessions','online','session','spot','comment','update'
    ];

    public function spots(){
        return $this->belongsTo(Spot::class);
    }
}
