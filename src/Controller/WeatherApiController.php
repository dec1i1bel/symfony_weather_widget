<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\GeocodingRepository;
use App\Repository\WeatherRepository;
use App\ThirdPartyApis\Weather\Connector;
use App\ThirdPartyApis\Weather\RequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class WeatherApiController extends AbstractController
{
    #[Route('/api/current/{countryCode}/{locationName}')]
    public function getLocationCurrentWeather(string $countryCode, string $locationName): JsonResponse
    {
        $location = new Location($locationName, $countryCode);
        $locationCoordinates = GeocodingRepository::obtainLocationCoordinates($location);
        $coordsWeather = WeatherRepository::obtainLocationWeather($locationCoordinates);

        return new JsonResponse([
            'status' => 'success',
            'coords-weather' => $coordsWeather
        ]);
    }

    #[Route('/api/demo_openweathermap', name: 'demo_openweathermap', methods: ['GET'])]
    public function demoRequest(): JsonResponse
    {
        $requestType = RequestType::Forecast->value;
        $getParams = ['id' => 524901];

        $con = new Connector($requestType, $getParams);

        if ($con->getRequestType() === null) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Incorrect request type',
            ]);
        }

        return $con->get();
    }
}
