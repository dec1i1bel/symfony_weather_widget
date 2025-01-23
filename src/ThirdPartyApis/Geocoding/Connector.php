<?php

namespace App\ThirdPartyApis\Geocoding;

use App\ThirdPartyApis\ConnectorBase;

class Connector extends ConnectorBase
{
    protected const API_ENDPOINT = 'http://api.openweathermap.org/geo/1.0/';

    public function getRequestType(): ?RequestType
    {
        return RequestType::tryFrom($this->requestType);
    }
}