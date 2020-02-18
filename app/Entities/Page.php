<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps=false;

    protected $fillable =[
        'company','name','title','logo',
        'background','style','banner','key'
    ];

    public function companies(){
        return $this->hasMany(Company::class);
    }

    public function spot(){
        return $this->belongsTo(Spot::class);
    }
}
