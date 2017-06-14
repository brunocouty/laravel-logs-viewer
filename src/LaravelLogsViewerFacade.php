<?php

namespace BrunoCouty\LaravelLogsViewer;

use Illuminate\Support\Facades\Facade;

class LaravelLogsViewerFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'brunocouty-laravel-logs-viewer';
    }
}