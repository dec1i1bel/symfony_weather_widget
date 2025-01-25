<?php

declare(strict_types=1);

namespace App\Entity;

readonly class LocationCoordinates
{
    /**
     * @param Location $location
     * @var Coordinates[] $coordinates
     */
    public function __construct(
        private Location $location,
        private array    $coordinates,
    ) {}

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function getCoordinates(): array
    {
        return $this->coordinates;
    }
}