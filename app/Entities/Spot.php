<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Monolog\Formatter\JsonFormatter;

/**
 * App\Entities\Spot
 *
 * @property int $id
 * @property int $company_id
 * @property string $address
 * @property string $type
 * @property string $interface
 * @property string $page_type
 * @property mixed|null $settings
 * @property string|null $last_activity
 * @property int $disabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereInterface($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot wherePageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @property string|null $ip
 * @property string|null $debug_key
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereDebugKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereName($value)
 * @property int $auth_type_id
 * @property-read \App\Entities\AuthType $authType
 * @property-read \App\Entities\Company $company
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Spot whereAuthTypeId($value)
 */
class Spot extends Model
{
    protected $fillable = [
        'company_id', 'address', 'type', 'Ident',
        'Page', 'last_activity', 'Key'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function updateSettings(): void
    {
        $settings = null;

        switch ($this->auth_type_id) {
            case AuthType::SMS_TYPE:
                $settings = [
                    'lf-sessions' => 48,
                    'country' => 'off',
                    'link' => env('OYSTER_REDIRECT_LINK')
                ];
                break;
            case AuthType::PROFILE_TYPE:
                $settings = ['multi-lang' => 'off', 'country' => 'off'];
                break;
        }

        $this->settings = is_array($settings) ?
            json_encode($settings, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : null;
    }

    public function authType()
    {
        return $this->hasOne(AuthType::class);
    }

    public function spotType()
    {
        return $this->hasMany(SpotType::class);
    }
}
