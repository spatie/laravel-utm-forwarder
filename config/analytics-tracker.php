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
        [
            'key' => 'utm_source',
            'source' => Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        ],
        [
            'key' => 'utm_medium',
            'source' => Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        ],
        [
            'key' => 'utm_campaign',
            'source' => Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        ],
        [
            'key' => 'utm_term',
            'source' => Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        ],
        [
            'key' => 'utm_content',
            'source' => Spatie\AnalyticsTracker\Sources\RequestParameter::class,
        ],
        [
            'key' => 'referer',
            'source' => Spatie\AnalyticsTracker\Sources\CrossOriginRequestHeader::class,
        ],
    ],

    /**
     * We'll put the tracked parameters in the session using this key.
     */
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
