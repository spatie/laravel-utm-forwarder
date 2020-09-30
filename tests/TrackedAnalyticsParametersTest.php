<?php

namespace Spatie\AnalyticsTracker\Tests;

use Illuminate\Http\Request;
use Spatie\AnalyticsTracker\Sources\RequestParameter;
use Spatie\AnalyticsTracker\TrackedAnalyticsParameters;

class TrackedAnalyticsParametersTest extends TestCase
{
    /** @test */
    public function it_can_get_the_tracked_parameters_from_a_request()
    {
        $request = new Request([
            'irrelevant' => 'value',
            'utm_source' => 'https://google.com/',
        ]);

        app(TrackedAnalyticsParameters::class)->putFromRequest($request);

        $this->assertEquals([
            'utm_source' => 'https://google.com/',
        ], session()->get(config('laravel-analytics-tracker.session_key')));
    }

    /** @test */
    public function it_can_get_custom_configured_tracked_parameters_from_a_request()
    {
        $request = new Request([
            'irrelevant' => 'value',
            'custom_tracked' => 'https://google.com/',
        ]);

        config()->set('laravel-analytics-tracker.tracked_parameters', [
            'custom_tracked' => RequestParameter::class,
        ]);

        app(TrackedAnalyticsParameters::class)->putFromRequest($request);

        $this->assertEquals([
            'custom_tracked' => 'https://google.com/',
        ], session()->get(config('laravel-analytics-tracker.session_key')));
    }

    /** @test */
    public function it_can_track_the_referer_header()
    {
        $request = new Request();
        $request->headers->add(['Referer' => 'spatie.be']);

        app(TrackedAnalyticsParameters::class)->putFromRequest($request);

        $this->assertEquals([
            'referer' => 'spatie.be',
        ], session()->get(config('laravel-analytics-tracker.session_key')));
    }
}