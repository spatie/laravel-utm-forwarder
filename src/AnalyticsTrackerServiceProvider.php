<?php

namespace Spatie\UtmForwarder;

use Illuminate\Support\ServiceProvider;

class AnalyticsTrackerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-analytics-tracker.php' => config_path('laravel-analytics-tracker.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-analytics-tracker.php', 'laravel-analytics-tracker');
    }
}
