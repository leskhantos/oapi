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

Route::get('spots/types','SpotTypeController@index'); // hz
Route::post('spots','SpotTypeController@store');
Route::post('add/sms','StatController@addSms');

Route::get('companies', 'CompaniesController@index');
Route::apiResource('company','CompaniesController')->except('index');
Route::get('company/{id}/guests','CompaniesController@guestsByCompany');
Route::get('company/{id}/calls','CompaniesController@callsByCompany');
Route::get('company/{id}/accounts','CompaniesController@accountsByCompany');

Route::get('company/{id}/spots','SpotController@spotsByCompany');
Route::get('spot/{id}','SpotController@show');
Route::post('company/spot', 'SpotController@store');

Route::get('company/{id}/pages','PageController@show');
Route::post('page','PageController@store');

Route::get('all/stats','StatController@getAllStat');
Route::get('sms/stats','StatController@getSmsPerMonth');

Route::post('device','DeviceController@store');

Route::post('account','AccountsController@store');

Route::get('settings','DefaultSettingController@index');
Route::post('settings','DefaultSettingController@store');
