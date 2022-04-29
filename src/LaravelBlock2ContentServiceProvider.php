<?php

namespace GMJ\LaravelBlock2Content;

use GMJ\LaravelBlock2Content\View\Components\Frontend;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelBlock2ContentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php", 'LaravelBlock2Content');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'LaravelBlock2Content');

        Blade::component("LaravelBlock2Content", Frontend::class);

        $this->publishes([
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'GMJ\LaravelBlock2Content');
    }


    public function register()
    {
    }
}
