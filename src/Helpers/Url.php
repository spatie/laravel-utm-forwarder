<?php

namespace Spatie\UtmForwarder\Helpers;

use Illuminate\Support\Arr;

class Url
{
    public static function host(string $url): ?string
    {
        $parts = parse_url($url) ?: [];

        return Arr::get($parts, 'host');
    }

    public static function addParameters(string $url, array $parameters = []): string
    {
        $queryString = http_build_query($parameters);

        $glue = parse_url($url, PHP_URL_QUERY) ? '&' : '?';

        return "{$url}{$glue}{$queryString}";
    }
}
