<?php

namespace Spatie\AnalyticsTracker\Sources;

use Spatie\AnalyticsTracker\Helpers\Request;

class CrossOriginRequestParameter extends RequestParameter
{
    public function get(string $key): ?string
    {
        if (! Request::isCrossOrigin($this->request)) {
            return null;
        }

        return parent::get($key);
    }
}
