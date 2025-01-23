<?php

declare(strict_types=1);

namespace App\ThirdPartyApis\OpenWeatherMap;

enum RequestType: string
{
    case Forecast = 'forecast';
    case Weather = 'weather';
}
