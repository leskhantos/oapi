<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class Account extends Authenticatable
{
    use  Notifiable, HasApiTokens;

    public $timestamps = false;

    protected $fillable = ['company_id', 'email', 'last_ip', 'last_online', 'password'];

    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
