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
 * @property int $id
 * @property string $name
 * @property int $disabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company whereDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Company whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Spot[] $spots
 * @property-read int|null $spots_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\User[] $users
 * @property-read int|null $users_count
 */
class Company extends Model
{
    public $timestamps=false;

    protected $fillable = [
        'name','enabled'
    ];

    public function spots(){
        return $this->hasMany(Spot::class,'id','company_id');
    }

    public function stats(){
        return $this->hasMany(ParentStats::class,'id','company_id');
    }

    public function pages(){
        return $this->belongsTo(Page::class);
    }

}
