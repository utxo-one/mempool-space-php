<?php

declare(strict_types=1);

namespace MempoolSpace\Client;

use MempoolSpace\Response\Transaction\TransactionResponse;

class TransactionClient extends AbstractClient
{
    public function getTransaction(string $txid): TransactionResponse
    {
        $url = $this->getApiUrl() . 'tx/' . urlencode($txid);
        $headers = $this->getRequestHeaders();
        $method = 'GET';
        $response = $this->getHttpClient()->request($method, $url, $headers);

        if ($response->getStatus() === 200) {
            return new TransactionResponse(json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR));
        } else {
            throw $this->getExceptionByStatusCode($method, $url, $response);
        }
    }
}
