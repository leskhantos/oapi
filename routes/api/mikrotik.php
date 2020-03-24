<?php

Route::post('enter','EnterController@enter');
Route::post('enter/{spot_id}','EnterController@enterWithPhone');
Route::get('enter/test', function () {
    return view('spot-template', [
        'data' => [
            'v1' => 'hfsahf',
            'v2' => '2',
            'v3' => '3',
            'v4' => '4',
            'v5' => '5',
            'v6' => '6',
            'v7' => '7',
            'v8' => '8',
            'type' => 1
        ]
    ]);
});
