<?php

namespace Spatie\AnalyticsTracker\Tests\Sources;

use Illuminate\Http\Request;
use Spatie\AnalyticsTracker\Sources\RequestHeader;
use Spatie\AnalyticsTracker\Tests\TestCase;

class RequestHeaderTest extends TestCase
{
    /** @test */
    public function it_can_get_a_request_header()
    {
        $request = new Request();
        $request->headers->set('Foo', 'bar');

        $this->assertEquals('bar', (new RequestHeader($request))->get('foo'));
    }
}
