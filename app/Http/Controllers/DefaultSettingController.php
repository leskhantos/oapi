<?php

namespace App\Http\Controllers;

use App\Entities\DefaultSetting;
use App\Http\Requests\Api\Settings\SettingsStoreRequest;

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
}
