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
                __DIR__ . '/../config/analytics-tracker.php' => config_path('analytics-tracker.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/analytics-tracker.php', 'analytics-tracker');

        $this->app->singleton(AnalyticsBag::class, function ($app) {
            return new AnalyticsBag(
                $app->make(Session::class),
                config('analytics-tracker.tracked_parameters'),
                config('analytics-tracker.session_key'),
            );
        });
    }
}
