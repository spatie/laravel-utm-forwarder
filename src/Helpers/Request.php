<?php

namespace Spatie\AnalyticsTracker\Helpers;

class Request
{
    public static function isCrossOrigin(\Illuminate\Http\Request $request): bool
    {
        $refererHost = Url::host($request->header('referer') ?? '');

        return $refererHost !== $request->getHost();
    }
}
