<?php

namespace Spatie\AnalyticsTracker\Tests;

use Illuminate\Support\Facades\Session;
use Spatie\AnalyticsTracker\AnalyticsTracker;

class AnalyticsTrackerTest extends TestCase
{
    /** @test */
    public function it_can_format_an_url_without_tracked_parameters()
    {
        $url = 'https://spatie.be/';

        $formattedUrl = app(AnalyticsTracker::class)->decorateUrl($url);

        $this->assertEquals($url, $formattedUrl);
    }

    /** @test */
    public function it_can_format_an_url_with_tracked_parameters()
    {
        Session::put(config('analytics-tracker.session_key'), [
            'utm_source' => 'https://laravel-news.com/',
        ]);

        $formattedUrl = app(AnalyticsTracker::class)->decorateUrl('https://spatie.be/');

        $this->assertEquals('https://spatie.be/?utm_source=https%3A%2F%2Flaravel-news.com%2F', $formattedUrl);
    }

    /** @test */
    public function it_can_format_an_url_with_tracked_and_mapped_parameters()
    {
        Session::put(config('analytics-tracker.session_key'), [
            'utm_source' => 'https://laravel-news.com/',
        ]);

        config()->set('analytics-tracker.parameter_url_mapping', [
            'utm_source' => 'custom_source',
        ]);

        $formattedUrl = app(AnalyticsTracker::class)->decorateUrl('https://spatie.be/');

        $this->assertEquals('https://spatie.be/?custom_source=https%3A%2F%2Flaravel-news.com%2F', $formattedUrl);
    }
}
