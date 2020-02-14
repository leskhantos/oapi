<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserAgent extends Model
{
    public $timestamps=false;
    protected $fillable =[
        'info','software','software_name','software_code',
        'software_version','software_type','engine_name',
        'engine_version','hardware_type','os',
        'os_name','os_code','os_version'
    ];
}
