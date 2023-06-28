<?php

namespace MempoolSpace\Response\Transaction;

use MempoolSpace\Response\AbstractResponse;

class TransactionVinResponse extends AbstractResponse
{
    public function getTxid(): string
    {
        return $this->getData()['txid'];
    }

    public function getVout(): int
    {
        return $this->getData()['vout'];
    }

    public function getPrevout(): TransactionPrevoutResponse
    {
        return new TransactionPrevoutResponse($this->getData()['prevout']);
    }

    public function getScriptSig(): string
    {
        return (string)$this->getData()['scriptsig'];
    }

    public function getScriptSigAsm(): string
    {
        return (string)$this->getData()['scriptsig_asm'];
    }

    public function getWitness(): array
    {
        return $this->getData()['witness'];
    }

    public function isCoinbase(): bool
    {
        return $this->getData()['is_coinbase'];
    }

    public function getSequence(): int
    {
        return $this->getData()['sequence'];
    }
}
