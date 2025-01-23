<?php

declare(strict_types=1);

namespace App\Entity;

readonly class Coordinates
{
    public function __construct(
        private readonly float $latitude,
        private readonly float $longitude,
    ) {}

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}