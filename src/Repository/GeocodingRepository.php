<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Location;
use App\Entity\Coordinates;
use App\Entity\LocationCoordinates;
use App\ThirdPartyApis\Geocoding\Connector;
use App\ThirdPartyApis\Geocoding\RequestType;
use PhpParser\JsonDecoder;

class GeocodingRepository
{
    public static function obtainLocationCoordinates(Location $location): ?LocationCoordinates
    {
        $requestType = RequestType::Direct;
        $getParams = ['q' => implode(',', [$location->getName(), $location->getCountryCode()]), 'limit' => 10];

        $con = new Connector($requestType->value, $getParams);

        if ($con->getRequestType() === null) {
            return null;
        }

        $response = $con->get();
        $responseRaw = (new JsonDecoder())->decode($response->getContent());
        $responseData = $responseRaw['data'];
        $coordinates = [];

        foreach ($responseData as $responseItem) {
            $lat = $responseItem['lat'] ?? null;
            $lon = $responseItem['lon'] ?? null;

            if (!isset($lat, $lon)) {
                continue;
            }

            $coordinates[] = new Coordinates($lat, $lon);
        }

        if (!$coordinates) {
            return null;
        }

        return new LocationCoordinates($location, $coordinates);
    }
}