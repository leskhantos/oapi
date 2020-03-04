<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::match(['get', 'post'], 'logout', 'Auth\AuthController@logout');
    Route::get('user', 'Auth\AuthController@user');
});

Route::apiResource('users','UsersController')->except('destroy');
Route::put('put-users/{id}/pass','UsersController@updatePassword');

Route::get('spots/types','SpotTypeController@index'); // для теста.
Route::post('spots','SpotTypeController@store');
Route::post('add/sms','StatController@addSms');
Route::post('add/call','StatController@addCall');
Route::post('add/guest','StatController@addGuest');
Route::post('add/voucher','StatController@addVoucher');
Route::post('add/device','StatController@addDevice');

Route::post('add','GuestController@store');
Route::get('company/{id}/guests','GuestController@guestByCompany');
Route::get('guest/{id}/spot','GuestController@guestBySpot');


Route::post('test','SpotController@test');
Route::get('spot/{id}/call','SpotController@callBySpot');
Route::get('spot/{id}/session','SpotController@sessionBySpot');
Route::get('spots/types/{id}/company','SpotController@spotTypesByCompany');

Route::get('companies', 'CompaniesController@index');
Route::apiResource('company','CompaniesController')->except('index');
Route::get('company/{id}/accounts','CompaniesController@accountsByCompany');

Route::get('company/{id}/spots','SpotController@spotsByCompany');
Route::get('spot/{id}','SpotController@show');
Route::post('company/spot', 'SpotController@store');
Route::put('spot/{id}','SpotController@update');

Route::get('company/{id}/pages','PageController@show');
Route::post('page','PageController@store');

Route::get('all/stats','StatController@getAllStat');
Route::get('all/stats/month','StatController@getAllStatsPerMonth');

Route::get('company/{id}/stats/month','StatController@getStatsByCompanyPerMonth');
Route::get('company/{id}/stats','StatController@getStatsByCompany');

Route::get('spot/{id}/stats/month','StatController@getStatsBySpotPerMonth');
Route::get('spot/{id}/stats','StatController@getStatsBySpot');

Route::post('device','DeviceController@store'); //возможно не нужны
Route::post('account','AccountsController@store');

Route::get('settings','DefaultSettingController@index');
Route::post('settings','DefaultSettingController@store');
