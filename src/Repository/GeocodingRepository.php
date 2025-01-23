<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Location;
use App\Entity\Coordinates;
use App\ThirdPartyApis\Geocoding\Connector;
use App\ThirdPartyApis\Geocoding\RequestType;

class GeocodingRepository
{
    public static function obtainLocationCoordinates(Location $location): ?Coordinates
    {
        $requestType = RequestType::Direct;
        $getParams = [
            'q' => implode(',', [$location->getName(), $location->getCountryCode()]),
            'limit' => 10,
        ];

        $con = new Connector($requestType->value, $getParams);

        if ($con->getRequestType() === null) {
            return null;
        }

        $responseData = $con->get();

        return new Coordinates(/*toDo: responseData['lat'], responseData['lon']*/);
    }
}