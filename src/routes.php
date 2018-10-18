<?php

Route::group(
    [
        'prefix' => 'logs',
    ],
    function () {
        Route::get('', ['as' => 'logs.index','uses' => '\BrunoCouty\LaravelViewLogs\Controllers\LogsController@index']);
        Route::get('download/{file}', ['as' => 'logs.download','uses' => '\BrunoCouty\LaravelViewLogs\Controllers\LogsController@download']);
    });