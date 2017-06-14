<?php

namespace BrunoCouty\LaravelLogsViewer;


use Illuminate\Support\ServiceProvider;

class LaravelLogsViewerServiceProvider extends ServiceProvider
{
    public function boot()
    {
//        Publish the views
        $this->publishes([
            __DIR__.'/resources/views/' => resource_path('views'),
        ]);
//        Reference path to resources
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/resources/views/logs', 'laravel-logs-viewer');
//        Publish vendor assets
//        To publish: php artisan vendor:publish --tag=public
        $this->publishes([
            __DIR__ . '/resources/assets/' => public_path("/vendor/laravel-logs-viewer"),
        ], 'public');
    }

    public function register()
    {

    }
}