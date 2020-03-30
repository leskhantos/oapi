<?php

namespace App\Http\Controllers;

use App\Entities\DefaultSetting;
use App\Http\Requests\Api\Settings\SettingsStoreRequest;
use App\Http\Requests\Api\Settings\SettingsUpdateRequest;

class DefaultSettingController extends Controller
{

    public function index()
    {
        return DefaultSetting::all();
    }

    public function store(SettingsStoreRequest $request)
    {
        return DefaultSetting::create($request->validated());
    }

    public function update($id, SettingsUpdateRequest $request)
    {
        $settings = DefaultSetting::findOrFail($id);
        $settings->update($request->validated());
        return $settings;
    }
}
