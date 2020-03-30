<?php

namespace App\Http\Requests\Api\Settings;

use App\Http\Requests\Api\ApiRequest;

class SettingsUpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'created' => 'date',
            'user_id' => 'required|exists:users,id|max:11',
            'redirect_url' => 'string|max:200',
            'session_auth_timer' => 'integer|max:6',
            'session_timer' => 'integer|max:6',
            'wait_enter_timer' => 'integer|max:4',
            'sms_phone_limit' => 'integer|max:4',
            'sms_device_limit' => 'integer|max:4',
            'sms_life_timer' => 'integer|max:4',
            'sms_allow_country' => 'integer|max:1',
            'call_wait_timer' => 'integer|max:6',
            'call_allow_country' => 'integer|max:1',
            'voucher_max_devices' => 'integer|max:6',
            'monitoring_enabled' => 'integer|max:1',
            'monitoring_alert_timer' => 'integer|max:6',
        ];
    }
}
