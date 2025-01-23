<?php

declare(strict_types=1);

namespace App\Entity;

class Location
{
    public function __construct(
        private readonly string $name,
        private readonly string $countryCode,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}