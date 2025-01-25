<?php

declare(strict_types=1);

namespace App\ThirdPartyApis\Weather;

use App\ThirdPartyApis\ConnectorBase;

class Connector extends ConnectorBase
{
    protected const API_ENDPOINT = 'https://api.openweathermap.org/data/2.5/';

    public function getRequestType(): ?RequestType
    {
        return RequestType::tryFrom($this->requestType);
    }
}