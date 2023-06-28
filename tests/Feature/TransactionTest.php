<?php

namespace MempoolSpace\Tests;

use MempoolSpace\Client\TransactionClient;
use MempoolSpace\Response\Transaction\TransactionPrevoutResponse;
use MempoolSpace\Response\Transaction\TransactionResponse;
use MempoolSpace\Response\Transaction\TransactionStatusResponse;
use MempoolSpace\Response\Transaction\TransactionVinListResponse;
use MempoolSpace\Response\Transaction\TransactionVoutListResponse;
use MempoolSpace\Response\Transaction\TransactionVoutResponse;
use PHPUnit\Framework\TestCase;

final class TransactionTest extends TestCase
{
    public function testItCanGetTransactionAndAllGettersAreSet(): void
    {
        $transactionClient = new TransactionClient();
        $transaction = $transactionClient->getTransaction('02a41e475443d4cfb9cb908d0956142f5976552b2b9e55d3ad7822a63c1b4162');

        $this->assertInstanceOf(TransactionResponse::class, $transaction);

        // Assert getters in TransactionResponse
        $this->assertIsString($transaction->getTxid());
        $this->assertIsInt($transaction->getVersion());
        $this->assertIsInt($transaction->getLocktime());
        $this->assertInstanceOf(TransactionVinListResponse::class, $transaction->getVin());
        $this->assertInstanceOf(TransactionVoutListResponse::class, $transaction->getVout());
        $this->assertIsInt($transaction->getSize());
        $this->assertIsInt($transaction->getWeight());
        $this->assertIsInt($transaction->getFee());
        $this->assertInstanceOf(TransactionStatusResponse::class, $transaction->getStatus());

        // Assert getters in TransactionStatusResponse
        $status = $transaction->getStatus();
        $this->assertIsBool($status->isConfirmed());
        $this->assertIsInt($status->getBlockHeight());
        $this->assertIsString($status->getBlockHash());
        $this->assertIsInt($status->getBlockTime());

        // Assert getters in TransactionVinResponse
        foreach($transaction->getVin()->all() as $vin) {
            $this->assertIsString($vin->getTxid());
            $this->assertIsInt($vin->getVout());
            $this->assertInstanceOf(TransactionPrevoutResponse::class, $vin->getPrevout());
            $this->assertIsString($vin->getScriptSig());
            $this->assertIsString($vin->getScriptSigAsm());
            $this->assertIsArray($vin->getWitness()); // Assert that witness is an array
            $this->assertNotEmpty($vin->getWitness()); // Assert that witness is not empty

            $this->assertIsBool($vin->isCoinbase());
            $this->assertIsInt($vin->getSequence());
        }

        // Assert getters in TransactionPrevoutResponse
        $prevout = $vin->getPrevout();
        $this->assertIsString($prevout->getScriptPubkey());
        $this->assertIsString($prevout->getScriptPubkeyAsm());
        $this->assertIsString($prevout->getScriptPubkeyType());
        $this->assertIsString($prevout->getScriptPubkeyAddress());
        $this->assertIsInt($prevout->getValue());

        // Assert getters in TransactionVoutResponse
        $vout = $transaction->getVout();

        foreach($vout->all() as $vout) {
            $this->assertIsString($vout->getScriptPubkey());
            $this->assertIsString($vout->getScriptPubkeyAsm());
            $this->assertIsString($vout->getScriptPubkeyType());
            $this->assertIsString($vout->getScriptPubkeyAddress());
            $this->assertIsInt($vout->getValue());
        }


    }

}
