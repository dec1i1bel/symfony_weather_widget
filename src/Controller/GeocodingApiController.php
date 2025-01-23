<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GeocodingApiController extends AbstractController
{
    public function getLocationCoordinates(string $locationName, string $countryCode): JsonResponse
    {
//        toDo
    }
}