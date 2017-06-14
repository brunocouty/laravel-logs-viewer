## Laravel Logs Viewer

This library provider an friendly interface to view and analyze the logs from Laravel.

![alt text][img-01]

[Click here to see more screenshots!](docs/images.md)

### Installation

```php
composer require brunocouty/laravel-logs-viewer
```

In your *config/app.php*, add the provider:

```php
\BrunoCouty\LaravelLogsViewer\LaravelLogsViewerServiceProvider::class,
```

You need publish the assets (*css and js files*):

```php
php artisan vendor:publish --tag=public
```

### Usage

To use this library, you need access the route "*/logs*" in your application.

```php
http://127.0.0.1:8000/logs
```

### Customizing

To customize the view of this library, publish:

```php
php artisan vendor:publish
```

Return:

```php
Copied Directory [/modules/brunocouty/laravel-logs-viewer/src/resources/views] To [/resources/views]
Copied Directory [/modules/brunocouty/laravel-logs-viewer/src/resources/assets] To [/public/vendor/laravel-logs-viewer]
```

The view is in: "*resources/views/logs*".

The css and js files are in: "*public/vendor/laravel-logs-viewer*".

## Like this content? Pay me a coffee!

Yeah! You like of this package? Pay me a coffee and help me to keep this package updated!

When you are my support, you have access to **exclusive posts** with a lot that cool things about PHP, Laravel, AngularJS, VueJS, Ionic, and much more! You will see haw create your own PHP Packages, resolve mistakes on your code... The great content!

Help me with only $1 / month and you will have access to my private content! 
And more, you need help to code your project? I can help you! Access my [Patreon Profile](https://www.patreon.com/brunocouty), I can help you via e-mail or skype!

[https://www.patreon.com/brunocouty](https://www.patreon.com/brunocouty)

[img-01]: docs/images/laravel-logs-viewer-01.png "Home Laravel Logs Viewer"