<?php

Route::post('login', 'AuthController@login');
Route::match(['get', 'post'], 'logout', 'AuthController@logout')->middleware('auth:api');
Route::get('user', 'AuthController@user')->middleware('auth:api');
