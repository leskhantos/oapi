<?php

Route::post('login', 'AuthController@login');
Route::match(['get', 'post'], 'logout', 'AuthController@logout');
Route::get('user', 'AuthController@user')->middleware('auth:api');
