<?php

return [
    /*
     * These are the analytics parameters that will be tracked when a user first visits
     * the application.
     *
     * Options are utm_source, utm_medium, utm_campaign, utm_term, utm_content and referer.
     */
    'tracked_parameters' => [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'referer',
    ],

    'session_key' => 'tracked_analytics_parameters',

    /*
     * When generating an URL with the tracked UTM parameters we'll use the following
     * mapping to put UTM parameters in URL parameters.
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
