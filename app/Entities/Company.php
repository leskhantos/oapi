<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Company
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company query()
 * @mixin \Eloquent
 */
class Company extends Model
{
    protected $fillable = [
        'user_id', 'name'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
