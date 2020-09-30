<?php

namespace Spatie\AnalyticsTracker;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AnalyticsBag
{
    protected Session $session;

    /** @var array[]|string[][] */
    protected array $trackedParameters;

    protected string $sessionKey;

    public function __construct(Session $session, array $trackedParameters, string $sessionKey)
    {
        $this->session = $session;
        $this->trackedParameters = $trackedParameters;
        $this->sessionKey = $sessionKey;
    }

    public function putFromRequest(Request $request)
    {
        $parameters = $this->determineFromRequest($request);

        $this->session->put($this->sessionKey, $parameters);
    }

    public function get(): array
    {
        return $this->session->get($this->sessionKey, []);
    }

    protected function determineFromRequest(Request $request): array
    {
        return collect($this->trackedParameters)
            ->mapWithKeys(function ($trackedParameter) use ($request) {
                $source = new $trackedParameter['source']($request);

                return [$trackedParameter['key'] => $source->get($trackedParameter['key'])];
            })
            ->filter()
            ->toArray();
    }
}
