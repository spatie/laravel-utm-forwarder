<?php

return [
    /*
     * These are the analytics parameters that will be tracked when a user first visits
     * the application. The configuration consists of the parameter's key and the
     * source to extract this key from.
     *
     * Available sources can be found in the `\Spatie\AnalyticsTracker\Sources` namespace.
     */
    'tracked_parameters' => [
        'utm_source' => \Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        'utm_medium' => \Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        'utm_campaign' => \Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        'utm_term' => \Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        'utm_content' => \Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        'referer' => \Spatie\AnalyticsTracker\Sources\CrossOriginRequestHeader::class,
    ],

    'session_key' => 'tracked_analytics_parameters',

    /*
     * When formatting an URL to add the tracked parameters we'll use the following
     * mapping to put tracked parameters in URL parameters.
     *
     * This is useful when using an analytics solution that ignores the utm_* parameters.
     */
    'parameter_url_mapping' => [
        'utm_source' => 'utm_source',
        'utm_medium' => 'utm_medium',
        'utm_campaign' => 'utm_campaign',
        'utm_term' => 'utm_term',
        'utm_content' => 'utm_content',
        'referer' => 'referer',
    ],
];
