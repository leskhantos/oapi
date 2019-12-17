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

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::match(['get', 'post'], 'logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
    });
});
