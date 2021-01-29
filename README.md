## UNFINISHED & NOT ON PACKAGIST!

# Keeps track of the original UTM (or other analytics) parameters

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-analytics-tracker.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-analytics-tracker)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/laravel-analytics-tracker/run-tests?label=tests)](https://github.com/spatie/laravel-analytics-tracker/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-analytics-tracker.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-analytics-tracker)

Cross domain analytics is hard. This package helps you to keep track of the visitor's original UTM parameters, referer header and other analytics parameters. You can then submit these parameters along with a form submission or add them to a link to another domain you track.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-utm-forwarder.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-utm-forwarder)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-analytics-tracker
```

The package works via a middleware that needs to be added to the `web` stack in your `kernel.php` file. Make sure to register this middleware after the `StartSession` middleware.

```php
// app/Http/Kernel.php

protected $middlewareGroups = [
    'web' => [
        // ...
        \Illuminate\Session\Middleware\StartSession::class,
        // ...

        \Spatie\AnalyticsTracker\Middleware\TrackAnalyticsParametersMiddleware::class,
    ],
];
```

To configure the tracked parameters or how they're mapped on the URL parameters, you can publish the config file using:

```bash
php artisan vendor:publish --provider="Spatie\AnalyticsTracker\AnalyticsTrackerServiceProvider"
```

This is the contents of the published config file:

```php
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
```

## Usage

The easiest way to retrieve the tracked parameters is by resolving the `TrackedAnalyticsParameters` class:

```php
use Spatie\AnalyticsTracker\AnalyticsBag;

app(AnalyticsBag::class)->get(); // returns an array of tracked parameters
```

You can also decorate an existing URL with the tracked parameters. This is useful to forward analytics to another domain you're running analytics on.

```blade
<a href="{{ app(\Spatie\AnalyticsTracker\AnalyticsTracker::class)->decorateUrl('https://mywebshop.com/') }}">
    Buy this product on our webshop
</a>

Will link to https://mywebshop.com?utm_source=facebook&utm_campaign=blogpost
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Alex Vanderbist](https://github.com/AlexVanderbist)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
