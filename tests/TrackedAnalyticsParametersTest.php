<?php

namespace Spatie\AnalyticsTracker\Tests;

use Illuminate\Http\Request;
use Spatie\AnalyticsTracker\AnalyticsBag;
use Spatie\AnalyticsTracker\Sources\RequestParameter;

class TrackedAnalyticsParametersTest extends TestCase
{
    /** @test */
    public function it_can_get_the_tracked_parameters_from_a_request()
    {
        $request = new Request([
            'irrelevant' => 'value',
            'utm_source' => 'https://google.com/',
        ]);

        app(AnalyticsBag::class)->putFromRequest($request);

        $this->assertEquals([
            'utm_source' => 'https://google.com/',
        ], session()->get(config('analytics-tracker.session_key')));
    }

    /** @test */
    public function it_can_get_custom_configured_tracked_parameters_from_a_request()
    {
        $request = new Request([
            'irrelevant' => 'value',
            'custom_tracked' => 'https://google.com/',
        ]);

        config()->set('analytics-tracker.tracked_parameters', [
            [
                'key' => 'custom_tracked',
                'source' => RequestParameter::class,
            ],
        ]);

        app(AnalyticsBag::class)->putFromRequest($request);

        $this->assertEquals([
            'custom_tracked' => 'https://google.com/',
        ], session()->get(config('analytics-tracker.session_key')));
    }

    /** @test */
    public function it_can_track_the_referer_header()
    {
        $request = new Request();
        $request->headers->add(['Referer' => 'spatie.be']);

        app(AnalyticsBag::class)->putFromRequest($request);

        $this->assertEquals([
            'referer' => 'spatie.be',
        ], session()->get(config('analytics-tracker.session_key')));
    }
}
