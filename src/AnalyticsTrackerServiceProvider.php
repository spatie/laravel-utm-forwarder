<?php

namespace Spatie\AnalyticsTracker;

use Illuminate\Contracts\Session\Session;
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

        $this->app->singleton(AnalyticsBag::class, function ($app) {
            return new AnalyticsBag(
                $app->make(Session::class),
                config('laravel-analytics-tracker.tracked_parameters'),
                config('laravel-analytics-tracker.session_key'),
            );
        });
    }
}
