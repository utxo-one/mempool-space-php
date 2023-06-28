<?php

namespace MempoolSpace\Response\Transaction;

use MempoolSpace\Response\AbstractResponse;

class TransactionResponse extends AbstractResponse
{
    public function getTxid(): string
    {
        return $this->getData()['txid'];
    }

    public function getVersion(): int
    {
        return $this->getData()['version'];
    }

    public function getLocktime(): int
    {
        return $this->getData()['locktime'];
    }

    public function getVin(): TransactionVinListResponse
    {
        return new TransactionVinListResponse($this->getData()['vin']);
    }

    public function getVout(): TransactionVoutListResponse
    {
        return new TransactionVoutListResponse($this->getData()['vout']);
    }

    public function getSize(): int
    {
        return $this->getData()['size'];
    }

    public function getWeight(): int
    {
        return $this->getData()['weight'];
    }

    public function getFee(): int
    {
        return $this->getData()['fee'];
    }

    public function getStatus(): TransactionStatusResponse
    {
        return new TransactionStatusResponse($this->getData()['status']);
    }
}
