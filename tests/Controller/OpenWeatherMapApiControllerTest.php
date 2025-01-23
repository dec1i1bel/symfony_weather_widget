<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class OpenWeatherMapApiControllerTest extends WebTestCase
{
    public function testDemoRequest(): void
    {
        $client = self::createClient();
        $client->request('GET', '/api/demo_openweathermap');

        self::assertResponseIsSuccessful();
    }
}
