<?php

namespace Spatie\AnalyticsTracker\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\AnalyticsTracker\AnalyticsTrackerServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            AnalyticsTrackerServiceProvider::class,
        ];
    }
}
