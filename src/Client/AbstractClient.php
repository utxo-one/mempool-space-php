<?php

declare(strict_types=1);

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
    private $baseUrl;
    /** @var string */
    private $apiPath = '/api/';
    /** @var ClientInterface */
    private $httpClient;

    private $network;

    public function __construct(ClientInterface $client = null, $network = 'mainnet')
    {
        if ($network == 'mainnet') {
            $this->baseUrl = 'https://mempool.space';
        } else {
            $this->baseUrl = 'https://mempool.space/testnet';
        }


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
