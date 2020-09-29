<?php

namespace Spatie\UtmForwarder\Helpers;

class Request
{
    public static function getCrossDomainReferer(\Illuminate\Http\Request $request): ?string
    {
        $referer = $request->header('referer');

        if (is_null($referer)) {
            return null;
        }

        $refererHost = Url::host($referer);

        if ($refererHost === $request->getHost()) {
            return null;
        }

        return $referer;
    }
}
