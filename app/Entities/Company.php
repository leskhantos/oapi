<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'enabled'
    ];

    public function spots()
    {
        return $this->hasMany(Spot::class);
    }

    public function stats()
    {
        return $this->hasMany(ParentStats::class, 'company_id', 'id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'company_id', 'id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'company_id', 'id');
    }

    public function countCompany()
    {
        $count_company = Company::count();
        return $count_company;
    }

}
