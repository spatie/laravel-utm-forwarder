<?php

namespace Spatie\AnalyticsTracker\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\AnalyticsTracker\TrackedAnalyticsParameters;

class TrackAnalyticsParametersMiddleware
{
    protected TrackedAnalyticsParameters $trackedAnalyticsParameters;

    public function __construct(TrackedAnalyticsParameters $trackedAnalyticsParameters)
    {
        $this->trackedAnalyticsParameters = $trackedAnalyticsParameters;
    }

    public function handle(Request $request, Closure $next)
    {
        $this->trackedAnalyticsParameters->putFromRequest($request);

        return $next($request);
    }
}
