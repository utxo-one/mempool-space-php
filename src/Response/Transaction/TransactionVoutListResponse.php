<?php

declare(strict_types=1);

namespace MempoolSpace\Response\Transaction;

use MempoolSpace\Response\AbstractListResponse;
use MempoolSpace\Response\Transaction\TransactionVinResponse;

class TransactionVoutListResponse extends AbstractListResponse
{
    /**
     * @return TransactionVoutResponse[]
     */
    public function all(): array
    {
        $transactionVouts = [];
        foreach ($this->getData() as $transactionVout) {
            $transactionVouts[] = new TransactionVoutResponse($transactionVout);
        }
        return $transactionVouts;
    }
}
