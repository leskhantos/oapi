<?php

Route::post('enter','EnterController@enter');
Route::post('enter/{spot_id}','EnterController@enterWithPhone');
