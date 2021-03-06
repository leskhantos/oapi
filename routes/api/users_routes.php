<?php

Route::apiResource('users', 'UsersController');
Route::put('put-users/{id}/pass', 'UsersController@updatePassword');
Route::put('put-accounts/{id}/pass', 'UsersController@updateAccountPassword');

Route::apiResource('spot/types', 'SpotTypeController')->only('index');

Route::post('add/sms', 'StatController@addSms');
Route::post('add/call', 'StatController@addCall');
Route::post('add/guest', 'StatController@addGuest');
Route::post('add/voucher', 'StatController@addVoucher');
Route::post('add/device', 'StatController@addDevice');
Route::post('add/session/auth', 'SessionController@addSessionAuth');
Route::post('add/session/spot', 'SessionController@addSessionSpot');
Route::post('test/call', 'SpotController@create');
Route::post('test/sms', 'SpotController@test');

Route::get('vouchers/{id}/generate','VouchersController@generateVouchers');
Route::get('vouchers/{id}/list','VouchersController@showList');
Route::get('vouchers/{id}/spot','VouchersController@getVouchersBySpot');
Route::put('vouchers/{spot_id}','VouchersController@update');
Route::get('list/{id}/vouchers','VouchersController@getVouchersByList');

Route::post('add', 'GuestController@store');
Route::get('company/{id}/guests', 'GuestController@guestByCompany');
Route::get('guest/{id}/spot', 'GuestController@guestBySpot');

Route::get('spot/{id}/call', 'SpotController@callBySpot');
Route::get('spot/{id}/sms', 'SpotController@smsBySpot');
Route::get('spot/types/{id}/company', 'SpotController@spotTypesByCompany');
Route::get('spot/{id}/event', 'SpotController@eventsBySpot');

Route::apiResource('companies', 'CompaniesController');
Route::get('company/{id}/accounts', 'CompaniesController@accountsByCompany');

Route::get('company/{id}/spots', 'SpotController@spotsByCompany');
Route::apiResource('spots', 'SpotController');

Route::get('company/{id}/pages', 'CompaniesController@pagesByCompany');
Route::post('page', 'StyleController@store');

Route::get('all/stats', 'StatController@getAllStat');
Route::get('all/stats/month', 'StatController@getAllStatsPerMonth');

Route::get('company/{id}/stats/month', 'StatController@getStatsByCompanyPerMonth');
Route::get('company/{id}/stats', 'StatController@getStatsByCompany');

Route::get('spot/{id}/stats/month', 'StatController@getStatsBySpotPerMonth');
Route::get('spot/{id}/stats', 'StatController@getStatsBySpot');

Route::get('spot/{id}/session', 'SessionController@sessionBySpot');

Route::post('device', 'DeviceController@store'); //возможно не нужны
Route::post('account', 'UsersController@storeAccount');

Route::apiResource('settings', 'DefaultSettingController')->except('destroy');


Route::get('device/{id}', 'DeviceController@show');
Route::get('device/{id}/main', 'DeviceController@mainByDevice');
Route::get('device/{id}/spots', 'DeviceController@spotsByDevice');
Route::get('device/{id}/sessions', 'DeviceController@sessionByDevice');
Route::get('device/{id}/phones', 'DeviceController@phoneByDevice');
Route::get('device/{id}/events', 'DeviceController@eventsByDevice');

// Route::post('/test/{id}', 'TestController@index');
