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

Route::get('roles', 'RolesController@index');
Route::get('spot/auth/types', 'AuthTypeController@index');

Route::apiResource('users','UsersController')->except('destroy');

Route::get('spots/types','SpotTypeController@index');
Route::post('spots/types','SpotTypeController@store');

Route::get('companies', 'CompaniesController@index');
Route::get('company/{id}', 'CompaniesController@show');
Route::post('company', 'CompaniesController@store');
Route::put('company/{id}', 'CompaniesController@update');
Route::delete('company/{id}', 'CompaniesController@destroy');

Route::get('spot','SpotController@index');
Route::post('company/spot', 'SpotController@store');

Route::get('user/info','UserAgentController@index');
Route::get('user/info/{id}','UserAgentController@show');
Route::post('user/info','UserAgentController@store');

Route::get('guest/call','GuestCallController@index');
Route::get('guest/call/{id}','GuestCallController@show');
Route::post('guest/call','GuestCallController@store');

Route::get('guest/sms','GuestSmsController@index');
Route::get('guest/sms/{id}','GuestSmsController@show');
Route::post('guest/sms','GuestSmsController@store');
