<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Account extends Model
{
    public $timestamps=false;
    protected $fillable = ['company_id','email','last_ip','last_online','password'];
    protected $hidden = ['password'];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function company(){
        return $this->hasMany(Company::class,'id','company_id');
    }
}
