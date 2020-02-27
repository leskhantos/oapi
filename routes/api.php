<?php

use Illuminate\Http\Request;

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

Route::get('companies', 'CompaniesController@index');
Route::apiResource('company','CompaniesController')->except('index');
Route::get('company/{id}/guests','CompaniesController@guestsByCompany');
Route::get('company/{id}/accounts','CompaniesController@accountsByCompany');

Route::get('company/{id}/spots','SpotController@spotsByCompany');
Route::get('spot/{id}','SpotController@show');
Route::post('company/spot', 'SpotController@store');

Route::get('company/{id}/pages','PageController@show');
Route::post('page','PageController@store');

Route::get('all/stats','StatController@getAllStat');

Route::get('stats/sms/month','StatController@getStatsSmsPerMonth');
Route::get('stats/calls/month','StatController@getStatsCallsPerMonth');
Route::get('stats/vouchers/month','StatController@getStatsVouchersPerMonth');

Route::get('stats/sms','StatController@getStatsSms');
Route::get('stats/calls','StatController@getStatsCalls');
Route::get('stats/vouchers','StatController@getStatsVouchers');

Route::get('company/{id}/stats/calls','StatController@getStatsCallsByCompany');
Route::get('company/{id}/stats/guests','StatController@getStatsGuestByCompany');
Route::get('company/{id}/stats/vouchers','StatController@getStatsVouchersByCompany');

Route::get('spot/{id}/stats/calls','StatController@getStatsCallsBySpot');
Route::get('spot/{id}/stats/guests','StatController@getStatsGuestBySpot');
Route::get('spot/{id}/stats/vouchers','StatController@getStatsVouchersBySpot');

Route::post('device','DeviceController@store');

Route::post('account','AccountsController@store');

Route::get('settings','DefaultSettingController@index');
Route::post('settings','DefaultSettingController@store');
