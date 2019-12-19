<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

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
 */
class Spot extends Model
{
    const SMS_TYPE = 'sms';
    const SMS_API_TYPE = 'sms-api';
    const TICKET_TYPE = 'ticket';
    const DATA_TYPE = 'data';
    const NO_PASS_TYPE = 'nopass';
    const CALL_TYPE = 'call';
    const CUSTOM_TYPE = 'custom';

    const SMS_PAGE_TYPE = 'sms';
    const CALL_PAGE_TYPE = 'call';
    const TICKET_PAGE_TYPE = 'ticket';
    const DATA_PAGE_TYPE = 'data';

    protected $fillable = [
        'company_id', 'address', 'type', 'interface',
        'page_type', 'settings', 'last_activity', 'disabled'
    ];
}
