<?php

declare(strict_types=1);

namespace App\ThirdPartyApis\Weather;

enum RequestType: string
{
    case Forecast = 'forecast';
    case Weather = 'weather';
}
