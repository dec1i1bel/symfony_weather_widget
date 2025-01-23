<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\GeocodingRepository;
use App\ThirdPartyApis\OpenWeatherMap\Connector as  OWMConnector;
use App\ThirdPartyApis\OpenWeatherMap\RequestType as OWMRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class OpenWeatherMapApiController extends AbstractController
{
    public function getLocationCurrentWeather(string $locationName, string $countryCode): JsonResponse
    {
        $location = new Location($locationName, $countryCode);
        $coordinates = GeocodingRepository::obtainLocationCoordinates($location);
        $weather = OpenWeatherApiRepository::obtainWeather($coordinates);

        return new JsonResponse([
            'status' => 'success',
            'weather' => $weather
        ]);
    }

    #[Route('/api/demo_openweathermap', name: 'demo_openweathermap', methods: ['GET'])]
    public function demoRequest(): JsonResponse
    {
        $requestType = OWMRequestType::Forecast->value;
        $getParams = ['id' => 524901];

        $connector = new OWMConnector($requestType, $getParams);

        if ($connector->getRequestType() === null) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Incorrect request type',
            ]);
        }

        return $connector->get();
    }
}
