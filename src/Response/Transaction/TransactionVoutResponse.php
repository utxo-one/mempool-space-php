<?php

namespace MempoolSpace\Response\Transaction;

use MempoolSpace\Response\AbstractResponse;

class TransactionVoutResponse extends AbstractResponse
{
    public function getScriptPubkey(): string
    {
        return $this->getData()['scriptpubkey'];
    }

    public function getScriptPubkeyAsm(): string
    {
        return $this->getData()['scriptpubkey_asm'];
    }

    public function getScriptPubkeyType(): string
    {
        return $this->getData()['scriptpubkey_type'];
    }

    public function getScriptPubkeyAddress(): string
    {
        return $this->getData()['scriptpubkey_address'];
    }

    public function getValue(): int
    {
        return $this->getData()['value'];
    }
}
