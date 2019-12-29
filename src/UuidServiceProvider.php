<?php

namespace Bmatovu\Uuid;

use Illuminate\Support\ServiceProvider;

class UuidServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/uuid.php' => base_path('config/uuid.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('uuid', function () {
            return new Uuid();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/uuid.php', 'uuid');
    }
}
