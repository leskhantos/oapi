<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id','company_id', 'name', 'title', 'logo',
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
