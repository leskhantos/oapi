<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'company_id', 'name', 'type', 'title', 'logo',
        'background', 'style', 'banner', 'debug_key'
    ];

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
}
