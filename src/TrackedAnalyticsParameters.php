<?php

namespace Spatie\AnalyticsTracker;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Spatie\AnalyticsTracker\Helpers\Request as RequestHelper;

class TrackedAnalyticsParameters
{
    protected Session $session;

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
        $parameters = [];

        foreach ($this->trackedParameters as $parameter => $source) {
            $parameters[$parameter] = (new $source($request))->get($parameter);
        }

        return array_filter($parameters);
    }
}
