<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\AuthType
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\AuthType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\AuthType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\AuthType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\AuthType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\AuthType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\AuthType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\AuthType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\AuthType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AuthType extends Model
{
    const PROFILE_TYPE = 1;
    const SMS_TYPE = 2;
}
