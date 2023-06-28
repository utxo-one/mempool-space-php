<?php

namespace MempoolSpace\Response\Transaction;

use MempoolSpace\Response\AbstractResponse;

class TransactionStatusResponse extends AbstractResponse
{
    public function isConfirmed(): bool
    {
        return $this->getData()['confirmed'];
    }

    public function getBlockHeight(): int
    {
        return $this->getData()['block_height'];
    }

    public function getBlockHash(): string
    {
        return $this->getData()['block_hash'];
    }

    public function getBlockTime(): int
    {
        return $this->getData()['block_time'];
    }
}
