<?php

namespace MempoolSpace\Client;

use MempoolSpace\Exception\BadRequestException;
use MempoolSpace\Exception\ForbiddenException;
use MempoolSpace\Exception\RequestException;
use MempoolSpace\Http\ClientInterface;
use MempoolSpace\Http\CurlClient;
use MempoolSpace\Http\Response;

class AbstractClient
{
    /** @var string */
    private $apiKey;
    /** @var string */
    private $baseUrl;
    /** @var string */
    private $apiPath = '/api/v1/';
    /** @var ClientInterface */
    private $httpClient;

    public function __construct(string $baseUrl, string $apiKey, ClientInterface $client = null)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->apiKey = $apiKey;

        // Use the $client parameter to use a custom cURL client, for example if you need to disable CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER
        if ($client === null) {
            $client = new CurlClient();
        }
        $this->httpClient = $client;
    }

    protected function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    protected function getApiUrl(): string
    {
        return $this->baseUrl . $this->apiPath;
    }

    protected function getApiKey(): string
    {
        return $this->apiKey;
    }

    protected function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    protected function getRequestHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getApiKey()
        ];
    }

    protected function getExceptionByStatusCode(
        string $method,
        string $url,
        Response $response
    ): RequestException {
        $exceptions = [
            ForbiddenException::STATUS => ForbiddenException::class,
            BadRequestException::STATUS => BadRequestException::class,
        ];

        $class = $exceptions[$response->getStatus()] ?? RequestException::class;
        $e = new $class($method, $url, $response);
        return $e;
    }
}
