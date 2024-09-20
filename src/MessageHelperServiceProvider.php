<?php

namespace Zacz\MessageHelper;

use Illuminate\Support\Facades\Config;

class MessageHelperServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/MessageHelper.php' => config_path('MessageHelper.php'),
        ]);

    }

    public function register()
    {
        $this->app->singleton('MessageHelper', function ($app) {
            return new MessageHelper($app['config']);
        });
    }

}
