<?php

declare(strict_types=1);

namespace MempoolSpace\Response\Transaction;

use MempoolSpace\Response\AbstractListResponse;
use MempoolSpace\Response\Transaction\TransactionVinResponse;

class TransactionVinListResponse extends AbstractListResponse
{
    /**
     * @return TransactionVinResponse[]
     */
    public function all(): array
    {
        $transactionVins = [];
        foreach ($this->getData() as $transactionVin) {
            $transactionVins[] = new TransactionVinResponse($transactionVin);
        }
        return $transactionVins;
    }
}
