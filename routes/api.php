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

Route::get('users', 'UsersController@index');
Route::post('user', 'UsersController@store');
Route::put('user/{id}', 'UsersController@update');


Route::get('companies', 'CompaniesController@index');
Route::get('company/{id}', 'CompaniesController@show');
Route::post('company', 'CompaniesController@store');
Route::put('company/{id}', 'CompaniesController@update');
Route::delete('company/{id}', 'CompaniesController@destroy');

