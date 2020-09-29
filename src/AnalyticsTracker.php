<?php

namespace Spatie\UtmForwarder;

use Spatie\UtmForwarder\Helpers\Url;

class AnalyticsTracker
{
    protected TrackedAnalyticsParameters $trackedAnalyticsParameters;

    public function __construct(TrackedAnalyticsParameters $trackedAnalyticsParameters)
    {
        $this->trackedAnalyticsParameters = $trackedAnalyticsParameters;
    }

    public function formatUrl(string $url): string
    {
        $analyticsParameters = $this->trackedAnalyticsParameters->get();
        $analyticsParameters = $this->mapParametersToUrlParameters($analyticsParameters);

        return Url::addParameters($url, $analyticsParameters);
    }

    protected function mapParametersToUrlParameters(array $parameters): array
    {
        $mapping = config('laravel-analytics-tracker.parameter_url_mapping');

        return collect($parameters)
            ->mapWithKeys(fn (string $value, string $parameter) => [$mapping[$parameter] ?? $parameter => $value])
            ->toArray();
    }
}
