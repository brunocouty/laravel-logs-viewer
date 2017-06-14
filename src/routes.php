<?php

Route::group(
    [
        'prefix' => 'logs',
        'namespace' => 'BrunoCouty\LaravelLogsViewer\Controllers'
    ],
    function () {
        Route::get('', ['as' => 'logs.index','uses' => 'LogsController@index']);
        Route::get('download/{file}', ['as' => 'logs.download','uses' => 'LogsController@download']);
    });