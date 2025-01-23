<?php

declare(strict_types=1);

namespace App\ThirdPartyApis;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class ConnectorBase
{
    protected HttpClientInterface $httpClient;

    public function __construct(
        protected readonly string $requestType,
        protected readonly array $getParams = [],
        protected readonly array $postParams = [],
    ) {
        $this->httpClient = HttpClient::create();
    }

    public function get(): JsonResponse
    {
        try {
            $response = $this->httpClient->request('GET', $this->getUrl());
            $responseStatus = $response->getStatusCode();
            $responseData = $response->toArray();
        } catch (\Throwable $e) {
            return new JsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return new JsonResponse(
            ['status' => 'success', 'data' => $responseData],
            $responseStatus
        );
    }

    private function getUrl(): string
    {
        $url = static::API_ENDPOINT . '/' . $this->requestType . '?';

        foreach ($this->getParams as $paramName => $paramValue) {
            $url .= '&' . $paramName . '=' . $paramValue;
        }

//        toDo: API_KEY из env
        $url .= '&appid=' . static::API_KEY;

        return $url;
    }

    abstract public function getRequestType(): mixed;
}