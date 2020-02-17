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
}
