<?php

namespace Spatie\AnalyticsTracker\Helpers;

class Url
{
    public static function host(string $url): ?string
    {
        return parse_url($url,  PHP_URL_HOST);
    }

    public static function addParameters(string $url, array $parameters = []): string
    {
        if (! $parameters) {
            return $url;
        }

        $queryString = http_build_query($parameters);

        $glue = parse_url($url, PHP_URL_QUERY) ? '&' : '?';

        return "{$url}{$glue}{$queryString}";
    }
}
