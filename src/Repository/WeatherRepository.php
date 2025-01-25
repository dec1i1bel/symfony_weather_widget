<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\LocationCoordinates;
use App\ThirdPartyApis\Weather\Connector;
use App\ThirdPartyApis\Weather\RequestType;
use PhpParser\JsonDecoder;

class WeatherRepository
{
    public static function obtainLocationWeather(LocationCoordinates $locationCoordinates): array
    {
        $requestType = RequestType::Weather;
        $coords = $locationCoordinates->getCoordinates();
        $coordsWeathers = [];

        foreach ($coords as $coord) {
            $latitude = $coord->getLatitude();
            $longitude = $coord->getLongitude();

            $getParams = ['lat' => $latitude, 'lon' => $longitude];
            $con = new Connector($requestType->value, $getParams);

            if ($con->getRequestType() === null) {
                continue;
            }

            $response = $con->get();
            $responseRaw = (new JsonDecoder())->decode($response->getContent());
            $responseData = $responseRaw['data'];

            $coordsWeathers[] = $responseData;
        }

        return $coordsWeathers;
    }
}